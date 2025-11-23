<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CartController extends Controller
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            if (Auth::check()) {
                //$product = Product::where('sku', $validatedData['sku'])->first();
                $cart = Cart::firstOrCreate(['user_id' => Auth::id()]); //lấy giỏ hàng của user hiện tại hoặc tạo mới nếu chưa có
                dump($cart);
                //thêm sản phẩm vào giỏ hàng
                $cart->cartItems()->updateOrCreate([
                    'product_id' => $validatedData['product_id'],
                    'quantity' => $validatedData['quantity'],
                ]);
                var_dump($cart);
                dd('dung dc');
            } else {
                $cart = session()->get('cart', []);
                $found = false;
                //kiểm tra sản phẩm đã có trong giỏ hàng chưa
                foreach ($cart as &$item) {
                    if ($item['product_id'] == $validatedData['product_id']) {
                        //nếu có thì cập nhật số lượng
                        $item['quantity'] += $validatedData['quantity'];
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    //nếu chưa có thì thêm sản phẩm mới
                    $cart[] = [
                        'product_id' => $validatedData['product_id'],
                        'quantity' => $validatedData['quantity'],
                    ];
                }

                session()->put('cart', $cart);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    public function storeAjax(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            // Tìm item hiện có
            $existingItem = $cart->cartItems()->where('product_id', $validated['product_id'])->first();

            if ($existingItem) {
                // Nếu đã có thì cộng dồn quantity
                $existingItem->update([
                    'quantity' => $existingItem->quantity + $validated['quantity']
                ]);
                $item = $existingItem;
            } else {
                // Nếu chưa có thì tạo mới
                $item = $cart->cartItems()->create([
                    'product_id' => $validated['product_id'],
                    'quantity' => $validated['quantity']
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Đã thêm vào giỏ',
                'cart_count' => $cart->cartItems()->sum('quantity'),
                'product' => [
                    'name' => $item->product->name,
                    'image' => asset('storage/' . $item->product->main_img_url),
                ]
            ]);
        }

        // Người chưa login → session
        $cart = session()->get('cart', []);
        $found = false;

        foreach ($cart as &$cartItem) {
            if ($cartItem['product_id'] == $validated['product_id']) {
                $cartItem['quantity'] += $validated['quantity'];
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ];
        }

        session()->put('cart', $cart);

        // Tính tổng quantity cho session cart
        $totalQuantity =  array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm vào giỏ',
            'cart_count' => $totalQuantity
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
