<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MediumController;
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

Auth::routes();

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

Route::get('/article/{id}/{idmed}', [ArticleController::class, 'detail']);

Route::get('/articles/add/{idmed}', [ArticleController::class, 'create']);

Route::post('/articles/add/{id}', [ArticleController::class, 'store']);

Route::get('/article/edit/{id}/{idmed}', [ArticleController::class, 'edit']);

Route::patch('/article/{id}/{idmed}', [ArticleController::class, 'update']);

Route::post('/articles/medium/{id}', [ArticleController::class, 'updatemedium']);

Route::delete('/article/{id}/{idmed}', [ArticleController::class, 'destroy']);

Route::post('/upload_image',[ArticleController::class, 'uploadImage'])->name('upload');

Route::get('/search', [MediumController::class, 'search']);

Route::get('/account', [AccountController::class, 'index']);

Route::patch('/account', [AccountController::class, 'update']);

Route::post('/account/favourite/medium/{id}', [AccountController::class, 'favmedium']);

Route::delete('/account/favourite/medium/delete/{id}', [AccountController::class, 'deletefavmedium']);

Route::post('/account/favourite/item/{id}/{idmed}', [AccountController::class, 'favitem']);

Route::delete('/account/favourite/item/delete/{id}/{idmed}', [AccountController::class, 'deletefavitem']);

Route::post('/account/favourite/article/{id}/{idmed}', [AccountController::class, 'favarticle']);

Route::delete('/account/favourite/article/delete/{id}/{idmed}', [AccountController::class, 'deletefavarticle']);

Route::get('/account/favourite', [AccountController::class, 'showfav']);

Route::get('/accounts', [AccountController::class, 'accounts']);

Route::get('/accounts/search', [AccountController::class, 'search']);

Route::delete('/accounts/{id}', [AccountController::class, 'destroy']);

Route::get('/home', [MediumController::class, 'index'])->name('home');

Route::get('/logout',function(){

    auth()->logout();

    return Redirect::to('/');
    
})->name('logout');
