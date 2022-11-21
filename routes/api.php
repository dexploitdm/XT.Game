<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get_info', [\App\Http\Controllers\HomeController::class, 'info']);
Route::get('/get_all_games', [\App\Http\Controllers\GameController::class, 'get_all_games']);
Route::get('/get_categories', [\App\Http\Controllers\GameController::class, 'get_categories']);
Route::get('/get_cat_games/{id}', [\App\Http\Controllers\GameController::class, 'get_cat_games']);
Route::get('/get_game/{id}', [\App\Http\Controllers\GameController::class, 'get_game']);
Route::get('/search/', [\App\Http\Controllers\GameController::class, 'search']);
Route::get('/get_selections', [\App\Http\Controllers\SelectionController::class, 'get_selections']);
Route::get('/get_selection/{id}', [\App\Http\Controllers\GameController::class, 'get_selection_games']);
Route::get('/get_selection_games/{id}', [\App\Http\Controllers\SelectionController::class, 'get_selection_games']);

Route::middleware(['is_admin'])->group(function () {
//    Route::get('/search_order/', [\App\Http\Controllers\Admin\OrderController::class, 'searchOrdersByUID']);
});
