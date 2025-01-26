<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'landing']);
Route::get('/products', [HomeController::class, 'products']);
Route::get('/products/{product}', [HomeController::class, 'showProduct']);


Route::get('/login', [HomeController::class, 'login']);
Route::get('/register', [HomeController::class, 'register']);
