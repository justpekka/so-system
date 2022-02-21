<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Undefined;

use App\Http\Controllers\ApiControllerV1;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemLogsController;
use App\Http\Controllers\ItemListsController;

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


Route::match(['get', 'post'], '/login', [UserController::class, 'login'])->name('user_login');

Route::prefix('/')
// ->middleware(['user.handle'])
->group(function() {

  /** @var Items RouteController */
  Route::group(["prefix" => '/item'], function() {
      Route::get('/', [ItemListsController::class, 'index']);
      Route::get('/{code}', [ItemLogsController::class, 'index']);
    });
    
});

// Route::get('/user', UserController::class);





Route::group(['prefix' => "/v1", 'controller' => ApiControllerV1::class], function() {
  Route::get('/', 'index')->name('ApiV1');

  /** @var V1Auth RouteController */
  Route::group(['prefix' => '/auth'], function() {
    Route::any('/', 'auth')->middleware('user.handle');
    Route::post('/register', 'registerUser');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
  });
  /** End of @var V1Auth RouteController */

  /** @var V1Items RouteController */
  // Route::group(['prefix' => '/items'], function() {
    // Route::any('/', 'auth')->middleware('user.handle');
    // Route::post('/register', 'registerUser');
    // Route::post('/login', 'login');
    // Route::post('/logout', 'logout');
  // });
  /** End of @var V1Items RouteController */
});