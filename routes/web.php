<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Undefined;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\SqlQueries;
use App\Http\Controllers\QueryBuilder;
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

Route::view('/welcome', 'archive.welcome');

Route::match(['get', 'post'], '/login', LoginController::class);
// Route::match(['get', 'post'], '/login', function() {
//     return "Hello world!";
// });