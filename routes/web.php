<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('trackers.index');

    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::patch('/products/{product}/toggle-status', [ProductController::class, 'handleActive'])->name('products.toggle-status');
    Route::patch('/products/{product}/end', [ProductController::class, 'end'])->name('products.end');
    Route::patch('/products/{product}/update-frequency', [ProductController::class, 'updateFrequency'])->name('products.update-frequency');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

