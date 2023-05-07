<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Category;
use App\Http\Controllers\Waste;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/category',         [Category::class, 'index']);
Route::get('/category/{id}',    [Category::class, 'show']);
Route::post('/category',        [Category::class, 'store']);
Route::put('/category/{id}',    [Category::class, 'update']);
Route::delete('/category/{id}', [Category::class, 'destroy']);

Route::get('/waste',            [Waste::class, 'index']);
Route::get('/waste/{id}',       [Waste::class, 'show']);
Route::post('/waste',           [Waste::class, 'store']);
Route::put('/waste/{id}',       [Waste::class, 'update']);
Route::delete('/waste/{id}',    [Waste::class, 'destroy']);