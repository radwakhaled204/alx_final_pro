<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

// Route::prefix('admin')->middleware('guest:admin')->group(function () {

//     Route::get('login', [LoginController::class, 'create'])->name('admin.login');
//     Route::post('login', [LoginController::class, 'store']);
// });

// Route::prefix('admin')->middleware([AdminAuth::class])->group(function () {

//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
//     Route::post('logout', [LoginController::class, 'destroy'])
//         ->name('admin.logout');
// });
Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);
});

// Routes for authenticated admin users
Route::prefix('admin')->middleware([AdminAuth::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/createCategory', function () {
        return view('categories/create');
    });
    Route::get('/createProduct', function () {
        return view('products/create');
    });

    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
});