<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


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
        View::composer('client.*', function ($view) {
            $categories = cache()->remember('categories_sidebar', 3600, function () {
                return Category::with('brands')->get();
            });

            $view->with('categories_sidebar', $categories);
        });
    }
}
