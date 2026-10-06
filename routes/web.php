<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{product}', [ShopController::class, 'show'])->name('product.show');

Route::get('/categories', [ShopController::class, 'categories'])->name('categories.index');
Route::get('/category/{category}', [ShopController::class, 'category'])->name('category.show');

Route::post('/cart/add/{product}', [ShopController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [ShopController::class, 'cart'])->name('cart.index');
Route::post('/cart/update/{id}', [ShopController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove/{id}', [ShopController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [ShopController::class, 'placeOrder'])->name('order.place');
Route::get('/order/{order}', [ShopController::class, 'orderSuccess'])->name('order.success');

Route::view('/about', 'about')->name('about');