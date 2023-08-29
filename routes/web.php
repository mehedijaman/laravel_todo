<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TodoController::class, 'index']);
Route::post('/store' ,[TodoController::class, 'store']);
Route::post('/edit/{id}' ,[TodoController::class, 'edit']);
Route::get('/edit/{id}' ,[TodoController::class, 'index']);
Route::post('/update/{id}' ,[TodoController::class, 'update']);
Route::post('/destroy/{id}' ,[TodoController::class, 'destroy']);
Route::post('/done/{id}' ,[TodoController::class, 'done']);
Route::post('/undo/{id}' ,[TodoController::class, 'undo']);
