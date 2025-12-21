<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // Tạo số đơn hàng ngẫu nhiên và đảm bảo không trùng lặp
    public function generateUniqueNumber($table, $column, $length = 8)
    {
       do{
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
        $promotionCode = $request->input('reductionCode', null);
        if (empty($products)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }
        if(empty($fullName) || empty($email) || empty($phone) || empty($address) || empty($tinh_thanh) || empty($quan_huyen) || empty($phuong_xa)) {
            return redirect()->back()->with('error', 'Vui lòng điền đầy đủ thông tin thanh toán.');
        }
        
        //Kiểm tra số lương sản phẩm trong kho
        foreach ($products as $pd) {
            $product = \App\Models\Product::find($pd['id']);
            if ($product) {
                $inventory = $product->inventory;
                if ($inventory && $pd['qty'] > $inventory->quantity) {
                    return redirect()->back()->with('error', 'Sản phẩm "' . $product->name .
                     '" không đủ số lượng trong kho.'."\n Vui lòng điều chỉnh lại giỏ hàng.");
                }
            }
        }
        // Tìm khuyến mãi nếu có
        $promotion = Promotion::where('code', $promotionCode)->first();
        // Tính tổng tiền
        $totalAmount = 0;
        foreach ($products as $pd) {
            $product = \App\Models\Product::find($pd['id']);
            if ($product) {
                $totalAmount += $product->price * $pd['qty'];
            }
        }

        if(Auth::check()){
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
            'discount_amount' => 0,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'note' => $note,
        ]);

        // Lưu các mục đơn hàng
        foreach ($products as $pd) {
            $product = \App\Models\Product::find($pd['id']);
            if ($product) {
                $order->orderItems()->create([
                    'product_id' => $product->product_id,
                    'sku' => $product->sku,
                    'product_name' => $product->name,
                    'quantity' => $pd['qty'],
                    'unit_price' => $product->price,
                    'line_total' => $product->price * $pd['qty'],
                    'created_at'=> now(),
                ]);
            }
        }
        //return redirect()->route('client.order.show', $order->order_id)->with('success', 'Đặt hàng thành công.');
        
        //Xóa giỏ hàng
        if(Auth::check()){
            $cart = \App\Models\Cart::where('user_id', $userId)->first();
            if($cart){
                $cart->cartItems()->delete();
            }
        } else {
            session()->forget('cart');
        }

        // Chuyển hướng đến trang thanh toán với mã đơn hàng
        return redirect()->route('checkout.success', ['order_number' => $randomNumber]);
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
}
