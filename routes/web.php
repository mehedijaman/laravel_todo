<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TodoController;

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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   Route::group(['prefix' => 'profile'],function(){
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
   });

    Route::get('/', [TodoController::class, 'index']);
    Route::post('/store' ,[TodoController::class, 'store']);
    Route::post('/edit/{id}' ,[TodoController::class, 'edit']);
    Route::get('/edit/{id}' ,[TodoController::class, 'index']);
    Route::post('/update/{id}' ,[TodoController::class, 'update']);
    Route::post('/destroy/{id}' ,[TodoController::class, 'destroy']);
    Route::post('/done/{id}' ,[TodoController::class, 'done']);
    Route::post('/undo/{id}' ,[TodoController::class, 'undo']);
});

require __DIR__.'/auth.php';
