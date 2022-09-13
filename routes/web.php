<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/game/{id}', function ($id) {return Inertia::render('game/id',['id' => $id]);})->name('show');
Route::get('/category/{id}', function ($id) {return Inertia::render('category/id',['id' => $id]);})->name('showCat');
Route::get('/selection/{id}', function ($id) {return Inertia::render('selection/id',['id' => $id]);})->name('showSelection');
//TODO: Или в контроллере достать модель и передать в вид
//Route::get('/game/{id}', [\App\Http\Controllers\HomeController::class, 'show']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {return Inertia::render('Dashboard');})->name('dashboard');
//    Route::get('/lk/game', function () {return Inertia::render('lk/game/list');})->name('GameList');
//    Route::get('/lk/game/add', function () {return Inertia::render('lk/game/add');})->name('addGame');
//    Route::get('/lk/game/edit/{id}', function () {return Inertia::render('lk/game/edit');})->name('editGame');

    Route::resource('/lk/game', \App\Http\Controllers\GameController::class);
    Route::resource('/lk/category', \App\Http\Controllers\CategoryController::class);
    Route::resource('/lk/selection', \App\Http\Controllers\SelectionController::class);

});

require __DIR__.'/auth.php';
