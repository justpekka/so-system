<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Undefined;

use App\Http\Controllers\Api\V1\Auth as ApiAuth;
use App\Http\Controllers\Api\V1\Items as ApiItem;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemListsController;

use App\Http\Controllers\AboardController;

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

Route::view('/welcome', 'archive.welcome')->name('welcome');

Route::get('/login', [ApiAuth::class, 'login'])->name('user_login')->middleware('user.handle');
Route::get('/logout', [ApiAuth::class, 'logout'])->name('user_logout');


Route::controller(ItemListsController::class)->prefix('/item')->middleware(['user.handle'])->name('dashboard.')
 ->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/{code}', 'detail')->name('detail');
});

Route::controller(AboardController::class)->prefix('/board')->middleware(['user.handle'])->name('board.')
 ->group(function() {
    Route::get('/', 'index');
});


Route::prefix("/v1")->name('v1.')->group(function() {
  Route::apiResource('/auth', ApiAuth::class)->except(['index']);
  
  Route::prefix('/auth')->controller(ApiAuth::class)->name('auth.')->group(function() {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
  });

  route::apiResource('/items', ApiItem::class);
  route::post('/items/stock-in/{item?}', [ApiItem::class, "stockIn"]);
  route::post('/items/stock-out/{item}', [ApiItem::class, "stockOut"]);
});