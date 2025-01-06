<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\NewsController;

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


Route::get('/', [TopController::class, 'top']);
Route::post('/news', [TopController::class, 'store']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/create', [BlogController::class, 'create']);
Route::get('/blogs/{blog}', [BlogController::class,'show']);
Route::post('/blogs',[BlogController::class, 'store']);
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit']);
Route::put('/blogs/{blog}', [BlogController::class, 'update']);
Route::delete('/blogs/{blog}', [BlogController::class, 'delete']);
