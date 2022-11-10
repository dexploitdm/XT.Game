<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/get_info', [\App\Http\Controllers\HomeController::class, 'info']);
Route::get('/get_all_games', [\App\Http\Controllers\GameController::class, 'get_all_games']);
Route::get('/get_categories', [\App\Http\Controllers\GameController::class, 'get_categories']);
Route::get('/get_cat_games/{id}', [\App\Http\Controllers\GameController::class, 'get_cat_games']);
Route::get('/get_game/{id}', [\App\Http\Controllers\GameController::class, 'get_game']);
Route::get('/search/', [\App\Http\Controllers\GameController::class, 'search']);
Route::get('/get_selections', [\App\Http\Controllers\SelectionController::class, 'get_selections']);
Route::get('/get_selection/{id}', [\App\Http\Controllers\GameController::class, 'get_selection_games']);
Route::get('/get_selection_games/{id}', [\App\Http\Controllers\SelectionController::class, 'get_selection_games']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user/orders', [\App\Http\Controllers\OrderController::class, 'getOrdersUser']);
    Route::post('/payment/{price}', [\App\Http\Controllers\OrderController::class, 'payment']);
});

Route::middleware(['is_admin'])->group(function () {
    //Route::post('/add_game', [\App\Http\Controllers\GameController::class, 'add_game']);
    //Route::get('/get_edit_game/{id}', [\App\Http\Controllers\GameController::class, 'get_edit_game']);
    //Route::get('/update_game/{id}', [\App\Http\Controllers\GameController::class, 'update_game']);
    Route::get('/search_order/', [\App\Http\Controllers\Admin\OrderController::class, 'searchOrdersByUID']);
});
