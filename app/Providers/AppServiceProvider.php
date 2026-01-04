<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Inventory;
use App\Observers\InventoryObserver;
use Illuminate\Support\Facades\Log;

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
        // Đăng ký observer cho Inventory
        Inventory::observe(InventoryObserver::class);
        //Chia sẻ dữ liệu giỏ hàng với tất cả các view
        view()->composer('*', function ($view) {
            $cart = Auth::check()
                ? Cart::where('user_id', Auth::id())->with('cartItems')->first()
                : session()->get('cart', []);

            $view->with('cart', $cart);
        });
    }
}
