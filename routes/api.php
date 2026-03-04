<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Tất cả route đều có prefix /api (được Laravel tự thêm).
| Xác thực JWT bằng middleware 'jwt.auth'.
|
| Public routes:   POST /api/auth/login, /api/auth/register
| Protected routes: Cần header "Authorization: Bearer {token}"
|
*/

// ────────────────────────────────────────────────────────
//  PUBLIC — Không cần token
// ────────────────────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('login',    [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

// ────────────────────────────────────────────────────────
//  PROTECTED — Cần JWT token hợp lệ
// ────────────────────────────────────────────────────────
Route::middleware('jwt.auth')->group(function () {

    // Auth: refresh / logout / profile
    Route::prefix('auth')->group(function () {
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('logout',  [AuthController::class, 'logout']);
        Route::get('me',       [AuthController::class, 'me']);
    });

    // ── Ví dụ: Route dành cho Admin (cần thêm middleware jwt.admin) ──
    // Route::middleware('jwt.admin')->prefix('admin')->name('api.admin.')->group(function () {
    //     Route::apiResource('categories', \App\Http\Controllers\Api\CategoryController::class);
    //     Route::apiResource('products',   \App\Http\Controllers\Api\ProductController::class);
    //     Route::apiResource('orders',     \App\Http\Controllers\Api\OrderController::class);
    // });
});
