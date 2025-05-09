<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'landing']);

Route::get('/products', [HomeController::class, 'products']);
Route::get('/products/{product}', [HomeController::class, 'showProduct']);

Route::get('/carts', [HomeController::class, 'carts'])->middleware('auth');
Route::post('/carts/{product:slug}', [HomeController::class, 'addToCart'])->middleware('auth')->name('carts.add');

Route::get('/cart-remove/{cart}', [HomeController::class, 'removeCart'])->middleware('auth');


Route::post('/buy-from-cart', [HomeController::class, 'buyFromCart'])->middleware('auth');
Route::get('/success/{checkout}', [HomeController::class, 'success'])->middleware('auth');
Route::get('/failure/{checkout}', [HomeController::class, 'failure'])->middleware('auth');

// route FAQ
Route::get('/faq', [HomeController::class, 'faq']);

// route profile
Route::resource('/profile', ProfileController::class)->middleware('auth');;
Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->middleware('auth');

Route::put('/profile/edit/name', [ProfileController::class, 'updateName'])->middleware('auth');
Route::put('/profile/edit/email', [ProfileController::class, 'updateEmail'])->middleware('auth');
Route::put('/profile/edit/phone', [ProfileController::class, 'updatephone'])->middleware('auth');
Route::put('/profile/edit/address', [ProfileController::class, 'updateAddress'])->middleware('auth');
Route::put('/profile/edit/{field}', [ProfileController::class, 'updateProfileField'])->middleware('auth');

// route autentikasi
Route::get('/login', [HomeController::class, 'login'])->middleware('guest');
Route::post('/login', [HomeController::class, 'actionLogin'])->name('login')->middleware('guest');
Route::delete('/logout', [HomeController::class, 'actionLogout'])->middleware('auth');
Route::get('/register', [HomeController::class, 'register'])->middleware('guest');
Route::post('/register', [HomeController::class, 'actionRegister'])->middleware('guest');

// add komentar
Route::post('/comments', [HomeController::class, 'actionComments'])->name('comments.store')->middleware('auth');


// Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [HomeController::class, 'forgotPassword'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [HomeController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');


// Route History Pembelian
Route::get('/history', [HomeController::class, 'history'])->middleware('auth')->name('history.index');

// route comments
Route::post('/comments', [HomeController::class, 'actionComments'])->name('comments.store');

// 404
Route::fallback(function () {
    return response()->view('404.index', [
        'title' => 'Halaman Tidak Ditemukan'
    ], 404);
});

Route::post('/', [HomeController::class, 'personalize'])->middleware('auth');
