<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

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
        // ✅ Fix for older MySQL versions (index length issue)
        Schema::defaultStringLength(191);

        // ✅ Use Bootstrap pagination instead of Tailwind
        Paginator::useBootstrapFive();
        // Or if you use Bootstrap 4
        // Paginator::useBootstrap();

        // ✅ Share cart count with all views
        View::composer('*', function ($view) {
            $cart = Session::get('cart', []);
            $cartCount = is_array($cart) ? count($cart) : 0;
            $view->with('cartCount', $cartCount);
        });
    }
}
