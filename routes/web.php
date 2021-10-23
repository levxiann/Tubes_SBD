<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MediumController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/', [MediumController::class, 'index']);

Route::get('/medium', [MediumController::class, 'index']);

Route::post('/medium/add', [MediumController::class, 'store']);

Route::get('/medium/{id}' , [MediumController::class, 'show']);

Route::patch('/medium/{id}', [MediumController::class, 'update']);

Route::delete('/medium/{id}', [MediumController::class, 'destroy']);

Route::get('item/{id}', [ItemController::class, 'index']);

Route::get('/item/{id}/{idmed}', [ItemController::class, 'detail']);

Route::post('/item/add/{id}', [ItemController::class, 'store']);

Route::patch('/item/{id}/{idmed}', [ItemController::class, 'update']);

Route::post('/item/medium/{id}', [ItemController::class, 'updatemedium']);

Route::delete('/item/{id}/{idmed}', [ItemController::class, 'destroy']);

Route::get('/article/{id}' , [ArticleController::class, 'index']);

Route::get('/article/{id}', [ArticleController::class, 'detail']);

Route::get('/search', [MediumController::class, 'search']);
