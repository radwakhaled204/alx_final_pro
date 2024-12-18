<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemsController;


// Route for Homepage
Route::get('/', [ProductController::class, 'welcome'])->name('products.welcome');
// Route for Product Details
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


// Profile routes (grouped with auth middleware)
Route::middleware('auth')->group(function () {
    // Route::get('/orders', [OrderController::class, 'userOrders'])->name('user.orders');
    // Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    // Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Routes for Cart and Cart Items
    Route::resource('cart', CartController::class)->except('showCart');
    Route::resource('cart-items', CartItemsController::class);

    // Confirm order route (GET request)
    Route::get('/confirm-order', [CartController::class, 'confirmOrder'])->name('confirm.order');

    // Place order route (POST request)
    Route::post('/place-order', [CartController::class, 'placeOrder'])->name('order.place');

    // Store cart items (protected by auth middleware)
    Route::post('/cart-items/store', [CartItemsController::class, 'store'])->name('cart-items.store');
});



// Include additional route files
require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';
