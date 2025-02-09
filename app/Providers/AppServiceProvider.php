<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
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
                ? Cart::with('product')
                      ->where('user_id', Auth::id())
                      ->latest()
                      ->limit(10)
                      ->get()
                : collect(); // Kosong jika belum login

            $cartCount = Auth::check()
                ? Cart::where('user_id', Auth::id())->count()
                : 0;

            $view->with('carts', $carts)
                 ->with('cartCount', $cartCount);
        });

        Filament::serving(function () {
            if (session('error')) {
                Notification::make()
                    ->title('Akses Ditolak')
                    ->body(session('error'))
                    ->danger()
                    ->send();
            }
        });
    }
}
