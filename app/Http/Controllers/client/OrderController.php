<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Kiểm tra và áp dụng mã giảm giá
     */
    public function applyDiscount(Request $request)
    {
        $code = $request->input('code');
        $totalAmount = $request->input('totalAmount', 0);

        if (empty($code)) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng nhập mã giảm giá!'
            ]);
        }

        // Tìm mã giảm giá
        $promotion = Promotion::where('code', $code)
            ->where('is_active', true)
            ->first();

        if (!$promotion) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không tồn tại hoặc đã hết hạn!'
            ]);
        }

        // Kiểm tra thời gian hiệu lực
        $now = now();
        if ($promotion->starts_at && $now < $promotion->starts_at) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá chưa có hiệu lực!'
            ]);
        }

        if ($promotion->ends_at && $now > $promotion->ends_at) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã hết hạn!'
            ]);
        }

        // Kiểm tra số lần sử dụng
        if ($promotion->usage_limit && $promotion->times_used >= $promotion->usage_limit) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã hết lượt sử dụng!'
            ]);
        }

        // Tính giá trị giảm
        $discountAmount = 0;
        if ($promotion->discount_type === 'percent') {
            $discountAmount = ($totalAmount * $promotion->discount_value) / 100;
        } elseif ($promotion->discount_type === 'fixed') {
            $discountAmount = $promotion->discount_value;
        }

        // Đảm bảo giảm giá không vượt quá tổng tiền
        $discountAmount = min($discountAmount, $totalAmount);
        $finalAmount = $totalAmount - $discountAmount;

        return response()->json([
            'success' => true,
            'message' => 'Áp dụng mã giảm giá thành công!',
            'data' => [
                'promo_id' => $promotion->promo_id,
                'code' => $promotion->code,
                'discount_type' => $promotion->discount_type,
                'discount_value' => $promotion->discount_value,
                'discount_amount' => $discountAmount,
                'discount_amount_formatted' => number_format($discountAmount, 0, ',', '.') . ' ₫',
                'final_amount' => $finalAmount,
                'final_amount_formatted' => number_format($finalAmount, 0, ',', '.') . ' ₫'
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // Tạo số đơn hàng ngẫu nhiên và đảm bảo không trùng lặp
    public function generateUniqueNumber($table, $column, $length = 8)
    {
        do {
            $number = '';
            for ($i = 0; $i < $length; $i++) {
                $number .= rand(0, 9);
            }
            $exists = \Illuminate\Support\Facades\DB::table($table)->where($column, $number)->exists();
        } while ($exists);

        return $number;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $products = $request->input('products', []);
        $fullName = $request->input('billingName', '');
        $email = $request->input('email', '');
        $phone = $request->input('billingPhone', '');
        $tinh_thanh = $request->input('billingProvince', '');
        $quan_huyen = $request->input('billingDistrict', '');
        $phuong_xa = $request->input('billingWard', '');
        $address = $request->input('billingAddress', '');
        $note = $request->input('note', '');
        $paymentMethod = $request->input('paymentMethod', 'cod');
        $promoCode = $request->input('reductionCode', null); // Lấy promo_id từ form
        $promoID = $request->input('promo_id', null); // Lấy promo_id từ form

        if (empty($products)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }
        if (empty($fullName) || empty($email) || empty($phone) || empty($address) || empty($tinh_thanh) || empty($quan_huyen) || empty($phuong_xa)) {
            return redirect()->back()->with('error', 'Vui lòng điền đầy đủ thông tin thanh toán.');
        }

        $totalAmount = 0; // Tính tổng tiền
        $orderItemsData = [];
        //Kiểm tra số lương sản phẩm trong kho
        foreach ($products as $pd) {
            $product = Product::find($pd['id']);
            if ($product) {
                $inventory = $product->inventory;
                if (!$inventory) {
                    return redirect()->back()->with('error', 'Sản phẩm "' . $product->name .
                        '" hiện không có trong kho.' . "\n Vui lòng điều chỉnh lại giỏ hàng.");
                }
                if ($inventory->quantity_in_stock < $pd['qty']) {
                    //dd("inventory:".$inventory->quantity_in_stock,"pd:" . $pd['qty']);

                    return redirect()->back()->with('error', 'Sản phẩm "' . $product->name .
                        '" không đủ số lượng trong kho.' . "\n Vui lòng điều chỉnh lại giỏ hàng.");
                }
                // Tính toán tiền
                $itemTotal = $product->price * $pd['qty'];
                $totalAmount += $itemTotal;

                // Chuẩn bị dữ liệu để insert sau
                $orderItemsData[] = [
                    'product_id' => $product->product_id,
                    'sku' => $product->sku,
                    'product_name' => $product->name,
                    'quantity' => $pd['qty'],
                    'unit_price' => $product->price,
                    'line_total' => $itemTotal,
                ];

                // Cập nhật số lượng
                $currentQuantity = $inventory->quantity_in_stock;
                $inventory->quantity_in_stock = $currentQuantity - $pd['qty'];
                $inventory->last_updated = now();
                $inventory->save();
            }
        }

        // Tìm khuyến mãi nếu có (dùng promo_id từ AJAX)
        $promotion = null;
        $discountAmount = 0;
        if ($promoCode) {
            $promotion = Promotion::where('code', $promoCode)->first();
            //dd("code" .$promotion);
        } else if ($promoID) {
            $promotion = Promotion::find($promoID);
            //dd("id" .$promotion);
        }


        // Tính giảm giá nếu có promotion
        if ($promotion) {
            if ($promotion->discount_type === 'percent') {
                $discountAmount = ($totalAmount * $promotion->discount_value) / 100;
            } elseif ($promotion->discount_type === 'fixed') {
                $discountAmount = $promotion->discount_value;
            }
            // Đảm bảo giảm giá không vượt quá tổng tiền
            $discountAmount = min($discountAmount, $totalAmount);
        }

        // Tính tổng tiền sau giảm giá
        $finalAmount = $totalAmount - $discountAmount;

        if (Auth::check()) {
            $userId = Auth::id();
        } else {
            $userId = null; // Khách vãng lai
        }
        $randomNumber = $this->generateUniqueNumber('orders', 'order_number', 10);
        $order = Order::create([
            'order_number' => $randomNumber,
            'user_id' => $userId,
            'full_name' => $fullName,
            'email' => $email,
            'phone' => $phone,
            'address_snapshot' => "$address, $phuong_xa, $quan_huyen, $tinh_thanh",
            'promo_id' => $promotion ? $promotion->promo_id : null,
            'payment_method' => $paymentMethod,
            'shipping_fee' => 0,
            'subtotal' => $totalAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => $finalAmount,
            'status' => 'pending',
            'note' => $note,
        ]);

        // Lưu các mục đơn hàng
        $order->orderItems()->createMany($orderItemsData);


        // Cập nhật số lần sử dụng promotion
        if ($promotion) {
            $promotion->increment('times_used');
        }

        //Xóa giỏ hàng
        if (Auth::check()) {
            $cart = \App\Models\Cart::where('user_id', $userId)->first();
            if ($cart) {
                $cart->cartItems()->delete();
            }
        } else {
            session()->forget('cart');
        }

        // Chuyển hướng đến trang thanh toán với mã đơn hàng
        //return redirect()->route('checkout.topup', ['order_number' => $randomNumber]);
        return redirect()->route('checkout.success', ['id' => $randomNumber]);
    }

    /**
     * Hiển thị trang thanh toán với mã đơn hàng
     */
    public function topup($order_number)
    {
        // Tìm đơn hàng theo order_number
        $order = Order::where('order_number', $order_number)
            ->with(['orderItems.product'])
            ->first();

        // Kiểm tra đơn hàng có tồn tại không
        if (!$order) {
            return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng.');
        }

        // Kiểm tra nếu đơn hàng đã thanh toán thì không cho xem lại
        if ($order->status === 'completed') {
            return redirect()->route('home')->with('error', 'Đơn hàng đã hoàn thành.');
        }

        return view('client.topup', compact('order'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
        return view('client.checkout', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * Hiển thị trang thành công sau khi thanh toán
     */
    public function success()
    {
        $order_number = request()->route('id');
        $order = Order::where('order_number', $order_number)->firstOrFail();
        return view('client.order_success', compact('order'));
    }
}
