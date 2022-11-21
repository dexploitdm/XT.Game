<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {return Inertia::render('Home');})->name('home');
Route::get('/game/{id}', function ($id) {return Inertia::render('game/id',['id' => $id]);})->name('show');
Route::get('/category/all', function () {return Inertia::render('category/all');})->name('showAll');
Route::get('/category/{id}', function ($id) {return Inertia::render('category/id',['id' => $id]);})->name('showCat');
Route::get('/selection/{id}', function ($id) {return Inertia::render('selection/id',['id' => $id]);})->name('showSelection');
Route::get('/cart', function () {return Inertia::render('cart/index');})->name('cart');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/settings', function () {return Inertia::render('user/settings');})->name('settings');
    Route::post('/user/payment/{price}', [\App\Http\Controllers\OrderController::class, 'payment']);
    Route::resource('/user/orders/store', \App\Http\Controllers\OrderController::class);
    Route::get('/user/orders', function () {return Inertia::render('user/orders');})->name('orders');
    Route::get('/user/get_orders', [\App\Http\Controllers\OrderController::class, 'getOrdersUser']);
});

Route::middleware(['is_admin'])->group(function () {
    Route::get('/dashboard', function () {return Inertia::render('Dashboard');})->name('dashboard');
    Route::resource('/lk/game', \App\Http\Controllers\Admin\GameController::class);
    Route::resource('/lk/category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/lk/selection', \App\Http\Controllers\Admin\SelectionController::class);
    Route::resource('/lk/orders', \App\Http\Controllers\Admin\OrderController::class);
    Route::get('/lk/search_order/', [\App\Http\Controllers\Admin\OrderController::class, 'searchOrdersByUID']);
});

require __DIR__.'/auth.php';
