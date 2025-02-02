<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
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
        View::composer('*', function ($view) {
            $carts = Auth::check()
                ? Cart::with(['product'])->where('user_id', Auth::id())->latest()->limit(10)->get()
                : collect(); // Kosong jika belum login
    
            $view->with('carts', $carts);
        });
    }
}
