<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Undefined;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiControllerV1;

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
->middleware(['user.handle'])
->group(function() {
  Route::get('/dashboard', UserController::class);

  /** @var User RouteController */
  Route::prefix('/user')
    ->controller(UserController::class)
    ->group(function() {
      Route::get('/list', 'list');
    });
  /** End of @var User RouteController */
});

// Route::get('/user', UserController::class);

Route::prefix('/v1')
// ->middleware(['user.handle'])
->controller(ApiControllerV1::class)
->group(function() {
  Route::get('/', 'index');

  /** @var V1Auth RouteController */
  Route::prefix('/auth')
    ->group(function() {
      Route::post('/', 'auth');
      Route::post('/register', 'registerUser');
      Route::post('/login', 'login');
      Route::post('/logout', 'logout');
    });
  /** End of @var V1Auth RouteController */
});