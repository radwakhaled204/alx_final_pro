<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemsController;


// Routes for Cart and Cart Items
Route::get('/', [CartController::class, 'showCart'])->name('welcome');
Route::resource('cart', CartController::class)->except('showCart');
Route::resource('cart-items', CartItemsController::class);
// Confirm order route (GET request)
Route::get('/confirm-order', [CartController::class, 'confirmOrder'])->name('confirm.order');

// Place order route (POST request)
Route::post('/place-order', [CartController::class, 'placeOrder'])->name('order.place');


// Route for homepage and product details
Route::get('/', [ProductController::class, 'welcome'])->name('products.welcome');
// Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


// Store cart items (protected by auth middleware)
Route::post('/cart-items/store', [CartItemsController::class, 'store'])
    ->middleware('auth')
    ->name('cart-items.store');

// Dashboard (protected by auth and verified middleware)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (grouped with auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include additional route files
require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';
