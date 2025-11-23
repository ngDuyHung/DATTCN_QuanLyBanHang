<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         view()->composer('*', function ($view) {
            $cart = Auth::check()
                ? Cart::where('user_id', Auth::id())->with('cartItems')->first()
                : session()->get('cart', []);

            $view->with('cart', $cart);
        });
    }
}
