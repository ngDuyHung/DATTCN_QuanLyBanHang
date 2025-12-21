<?php

namespace App\Providers;

use App\Listeners\SePayWebhookListener;
use App\Models\Category;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use SePay\SePay\Events\SePayWebhookEvent;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Truyền $categories_sidebar chỉ áp dụng cho tất cả view trong thư mục client/*
        View::composer('*', function ($view) {
            $categories = cache()->remember('categories_sidebar', 3600, function () {
                return Category::with('brands')->get();
            });

            $view->with('categories_sidebar', $categories);
        });

        // 2. Đăng ký SePay Webhook Listener
        // Đoạn này giúp Laravel biết khi nào SePay bắn Event thì gọi Listener của bạn
        Event::listen(
            SePayWebhookEvent::class,
            SePayWebhookListener::class,
        );
    }
}
