<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'landing']);
Route::get('/products', [HomeController::class, 'products']);
Route::get('/products/{product}', [HomeController::class, 'showProduct']);

Route::get('/carts', [HomeController::class, 'carts'])->middleware('auth');
Route::post('/carts/{product}', [HomeController::class, 'addToCart'])->middleware('auth');
Route::get('/cart-remove/{cart}', [HomeController::class, 'removeCart'])->middleware('auth');


Route::post('/buy-from-cart', [HomeController::class, 'buyFromCart'])->middleware('auth');
Route::get('/success/{checkout}', [HomeController::class, 'success'])->middleware('auth');
Route::get('/failure/{checkout}', [HomeController::class, 'failure'])->middleware('auth');

Route::get('/checkouts', [HomeController::class, 'checkouts'])->middleware('auth');

// route profile
Route::resource('/profile', ProfileController::class)->middleware('auth');;
Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->middleware('auth');


// route autentikasi
Route::get('/login', [HomeController::class, 'login'])->middleware('guest');
Route::post('/login', [HomeController::class, 'actionLogin'])->name('login')->middleware('guest');
Route::delete('/logout', [HomeController::class, 'actionLogout'])->middleware('auth');
Route::get('/register', [HomeController::class, 'register'])->middleware('guest');
Route::post('/register', [HomeController::class, 'actionRegister'])->middleware('guest');

// add komentar
Route::post('/comments', [HomeController::class, 'actionComments'])->name('comments.store')->middleware('auth');
