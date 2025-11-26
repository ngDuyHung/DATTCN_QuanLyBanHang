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
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $cartItems = $cart->cartItems()->with('product')->get();
        } else {
            $sessionCart = session()->get('cart', []);
            $cartItems = collect($sessionCart)->map(function ($item) {
                $product = Product::find($item['product_id']);
                return (object)[
                    'product' => $product,
                    'quantity' => $item['quantity'],
                ];
            });
        }
        $totalPrice = $this->getTotalAmount($cartItems);
        return view('client.cart', compact('cartItems', 'totalPrice'));
    }

    // Tính tổng tiền
    private function getTotalAmount($cartItems)
    {
        return $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
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

        return $this->index();
    }

    public function showCheckout()
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $cartItems = $cart->cartItems()->with('product')->get();
        } else {
            $sessionCart = session()->get('cart', []);
            $cartItems = collect($sessionCart)->map(function ($item) {
                $product = Product::find($item['product_id']);
                return (object)[
                    'product' => $product,
                    'quantity' => $item['quantity'],
                ];
            });
        }
        $totalPrice = $this->getTotalAmount($cartItems);

        return view('client.checkout', compact('cartItems', 'totalPrice'));
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
    public function update(Request $request)
    {
        $totalPrice = 0;
        if (Auth::check()) {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,product_id',
                'quantity' => 'required|integer|min:1',
            ]);
            $cart = Cart::where(['user_id' => Auth::id()])->first();
            $cartItem = $cart->cartItems()->where('product_id', $validated['product_id'])->first();

            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $validated['quantity']
                ]);
                $totalPrice = $this->getTotalAmount($cart->cartItems);
            }
        } else {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,product_id',
                'quantity' => 'required|integer|min:1',
            ]);

            $cart = session()->get('cart', []);

            foreach ($cart as &$cartItem) {
                if ($cartItem['product_id'] == $validated['product_id']) {
                    $cartItem['quantity'] = $validated['quantity'];
                    break;
                }
            }

            session()->put('cart', $cart);
            // Tính tổng tiền sau khi cập nhật
            $cartItems = collect($cart)->map(function ($item) {
                $product = Product::find($item['product_id']);
                return (object)[
                    'product' => $product,
                    'quantity' => $item['quantity'],
                ];
            });
            $totalPrice = $this->getTotalAmount($cartItems);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật giỏ hàng thành công',
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id)
    {
        $totalPrice = 0;
        if (Auth::check()) {
            $cart = Cart::where(['user_id' => Auth::id()])->first();

            $cartItem = $cart->cartItems()->where('product_id', $product_id)->first();

            if ($cartItem) {
                $cartItem->delete();
            }
            $totalPrice = $this->getTotalAmount($cart->cartItems);
        } else {
            $cart = session()->get('cart', []);

            //lọc bỏ item có product_id trùng với product_id cần xóa
            $cart = array_filter($cart, function ($cartItem) use ($product_id) {
                return $cartItem['product_id'] != $product_id;
            });

            session()->put('cart', $cart);
            // Tính tổng tiền sau khi xóa
            $cartItems = collect($cart)->map(function ($item) {
                $product = Product::find($item['product_id']);
                return (object)[
                    'product' => $product,
                    'quantity' => $item['quantity'],
                ];
            });
            $totalPrice = $this->getTotalAmount($cartItems);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Đã xóa khỏi giỏ hàng',
            'totalPrice' => $totalPrice
        ]);
    }
}
