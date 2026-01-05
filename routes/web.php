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
    $router->resource('inventory', \App\Http\Controllers\admin\InventoryController::class);
    $router->resource('promotion', \App\Http\Controllers\admin\PromotionController::class);
    $router->resource('account', \App\Http\Controllers\admin\AccountController::class);

    // Setting - Menu management
    Route::get('/settings', [\App\Http\Controllers\admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\admin\SettingController::class, 'update'])->name('settings.update');
    $router->resource('menu', \App\Http\Controllers\admin\MenuController::class);
    Route::post('menus/change-status', [\App\Http\Controllers\admin\MenuController::class, 'changeStatus'])->name('menu.changeStatus');
    Route::get('menus/get-parent-menus', [\App\Http\Controllers\admin\MenuController::class, 'getParentMenusByType'])->name('menu.getParentMenusByType');

    // API Modal
    Route::get('/orders/api/{id}', [\App\Http\Controllers\admin\OrderController::class, 'getOrderDetailHtml'])
        ->name('order.show_api');

    Route::post('categories/change-status', [\App\Http\Controllers\admin\CategoryController::class, 'changeStatus'])->name('category.changeStatus');
    Route::post('products/change-status', [\App\Http\Controllers\admin\ProductController::class, 'changeStatus'])->name('product.changeStatus');
    Route::get('products/ajax-brands-by-category/{category_id}', [\App\Http\Controllers\admin\ProductController::class, 'getAjaxBrandsByCategory'])->name('product.AjaxBrandsByCategory');

    Route::get('/clear-cache', function () {
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        return back()->with('success', 'Đã xóa cache thành công!');
    })->name('home.clearCache');


    //tất cả mà bọc trong admin thì lúc gọi phải kèm admin.{route_name} ví dụ admin.product.index
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
Route::post('/checkout/apply-discount', [App\Http\Controllers\client\OrderController::class, 'applyDiscount'])->name('checkout.applyDiscount');
Route::get('/checkout/topup/{order_number}', [App\Http\Controllers\client\OrderController::class, 'topup'])->name('checkout.topup');
Route::get('/checkout/success/{id}', [App\Http\Controllers\client\OrderController::class, 'success'])->name('checkout.success');


//Router search
Route::get('/search', [App\Http\Controllers\client\SearchController::class, 'index'])->name('client.search.index');


// Account orders không cần đăng nhập
Route::prefix('account')->name('account.')->group(function (Router $router) {
    $router->get('/orders', [App\Http\Controllers\client\OrderController::class, 'indexClient'])->name('orders.indexClient');
    $router->get('/orders/{id}', [App\Http\Controllers\client\OrderController::class, 'showClient'])->name('orders.showClient');
});
// show by slug 
Route::get('/{slug}', [App\Http\Controllers\client\ProductController::class, 'showBySlug'])->name('client.showBySlug');
