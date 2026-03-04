<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',   // ← API routes (prefix /api)
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Đăng ký middleware alias
        $middleware->alias([
            'admin'     => \App\Http\Middleware\AdminMiddleware::class,
            'jwt.auth'  => \App\Http\Middleware\JwtAuthenticate::class,
            'jwt.admin' => \App\Http\Middleware\JwtAdminMiddleware::class,
        ]);

        // 1. Ngoại trừ CSRF cho Webhook SePay và tất cả API routes
        $middleware->validateCsrfTokens(except: [
            'api/*',
            'api/sepay/webhook',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

    
