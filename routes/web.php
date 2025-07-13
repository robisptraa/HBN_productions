<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::post('/order', [HomeController::class, 'store'])->name('create.order');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('packages', PackageController::class);
    Route::resource('products', ProductController::class);
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('/orders/{order}/verify', [OrderController::class, 'verify'])->name('orders.verify');
    Route::post('/orders/{order}/reject', [OrderController::class, 'reject'])->name('orders.reject');
});

require __DIR__ . '/auth.php';
