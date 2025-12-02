<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

// Auth routes (login, register, reset password)
Route::group(['prefix' => 'account'], function () {
    Auth::routes();
});


// Home page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
// Dashboard sau login
Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->middleware(['auth', 'admin'])->name('admin.dashboard');

// Admin routes (cần đăng nhập)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function (Router $router) {
    $router->resource('category', \App\Http\Controllers\admin\CategoryController::class);
    $router->resource('brand', \App\Http\Controllers\admin\BrandController::class);
    $router->resource('product', \App\Http\Controllers\admin\ProductController::class);
    $router->resource('order', \App\Http\Controllers\admin\OrderController::class);

    // API Modal
    Route::get('/orders/api/{id}', [\App\Http\Controllers\admin\OrderController::class, 'getOrderDetailHtml'])
        ->name('order.show_api');
});


// Client Product Detail
Route::get('/product/{id}', [App\Http\Controllers\client\ProductController::class, 'show'])->name('client.product.show');


//Cart routes
Route::post('/cart/store', [App\Http\Controllers\client\CartController::class, 'store'])->name('cart.store');

Route::get('/cart', [App\Http\Controllers\client\CartController::class, 'index'])->name('cart');

    
Route::post('/cart/store-ajax', [App\Http\Controllers\client\CartController::class, 'storeAjax'])->name('cart.storeAjax');
Route::post('/cart/update', [App\Http\Controllers\client\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete/{id}', [App\Http\Controllers\client\CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/cart/checkout', [App\Http\Controllers\client\CartController::class, 'showCheckout'])->name('cart.checkout');
Route::get('/cart/checkout', [App\Http\Controllers\client\CartController::class, 'showCheckout'])->name('cart.checkout.process');

//Checkout routes
Route::post('/checkout', [App\Http\Controllers\client\OrderController::class, 'store'])->name('checkout');
Route::get('/checkout/success/{order_number}', [App\Http\Controllers\client\OrderController::class, 'topup'])->name('checkout.success');

// show by slug 
Route::get('/{slug}', [App\Http\Controllers\client\ProductController::class, 'showBySlug'])->name('client.showBySlug');