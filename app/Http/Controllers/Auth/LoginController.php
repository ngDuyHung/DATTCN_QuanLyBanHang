<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $sessionCart = session()->get('cart', []);

        // trường hợp không có giỏ hàng
        if (!$user->cart) {
            $user->cart()->create();
        }
        foreach ($sessionCart as $item) {
            $cartItem = $user->cart->cartItems()->where('product_id', $item['product_id'])->first();

            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $cartItem->quantity + $item['quantity'],
                ]);
            } else {
                $user->cart->cartItems()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        session()->forget('cart');
    }
}
