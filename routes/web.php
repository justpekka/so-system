<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Undefined;

use App\Http\Controllers\ApiControllerV1;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemLogsController;
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

Route::get('/login', [ApiControllerV1::class, 'login'])->name('user_login')->middleware('user.handle');
Route::get('/logout', [ApiControllerV1::class, 'logout'])->name('user_logout');


/** @var Items RouteController */
Route::prefix('/item')->name('dashboard.')->middleware(['user.handle'])->group(function() {
  Route::get('/', [ItemListsController::class, 'index'])->name('index');
  Route::get('/{code}', [ItemLogsController::class, 'index'])->name('detail');
});

Route::group(['prefix' => '/board', 'controller' => AboardController::class], function() {
  Route::get('/', 'index');
});

// Route::get('/user', UserController::class);

Route::group(['prefix' => "/v1", 'controller' => ApiControllerV1::class], function() {
  Route::get('/', 'index')->name('ApiV1');

  /** @var V1Auth RouteController */
  Route::group(['prefix' => '/auth'], function() {
    Route::post('/register', 'registerUser');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
  });
  /** End of @var V1Auth RouteController */

});