<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;



Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);

});

// Routes for authenticated admin users
Route::prefix('admin')->middleware([AdminAuth::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('products', ProductController::class)->except('show', 'welcome');

    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
    
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
    
});

