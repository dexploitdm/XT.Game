<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_info', [\App\Http\Controllers\HomeController::class, 'info']);

Route::get('/get_all_games', [\App\Http\Controllers\GameController::class, 'get_all_games']);
Route::get('/get_game/{id}', [\App\Http\Controllers\GameController::class, 'get_game']);


Route::get('/get_selection_games/{id}', [\App\Http\Controllers\SelectionController::class, 'get_selection_games']);
//Route::post('/add_game', [\App\Http\Controllers\GameController::class, 'add_game']);
//Route::get('/get_edit_game/{id}', [\App\Http\Controllers\GameController::class, 'get_edit_game']);
//Route::get('/update_game/{id}', [\App\Http\Controllers\GameController::class, 'update_game']);
