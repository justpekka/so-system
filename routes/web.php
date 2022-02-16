<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Undefined;

use App\Http\Controllers\UserController;

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
  Route::redirect('/', '/welcome');
});

// Route::get('/user', UserController::class);