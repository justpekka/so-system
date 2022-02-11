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
/**
 * Route::get($uri, $callback);
 * Route::post($uri, $callback);
 * Route::put($uri, $callback);
 * Route::patch($uri, $callback);
 * Route::delete($uri, $callback);
 * Route::options($uri, $callback);
 * 
 * Route::view($uri, $view_file);
 * Route::match(['get', 'post'], '/', function () {});
 * Route::any('/', function () {});
 * Route::redirect('/here', '/there', $status_code);
 * Route::permanentRedirect('/here', '/there'); //301 status code
 * 
 * Route::resource($uri, $resource_controller)
 * Route::resources([
 *  'photos' => PhotoController::class,
 *  'posts' => PostController::class,
 * ]);
 */

Route::view('/welcome', 'archive.welcome');

Route::match(['GET', 'POST'], '/login', [LoginController::class, "login"]);

Route::prefix('/sales')
//   ->middleware('')
//   ->controller('')
->group(function() {
    $sales_builder = QueryBuilder::class;

    Route::redirect('/', 'dashboard');
    Route::get('/cashier', $sales_builder::Cashier);
    Route::match(["GET", "POST"], '/cashier/add', [$sales_builder::Cashier, 'create']);
    Route::match(["GET", "POST"], '/cashier/update/{id}', [$sales_builder::Cashier, 'update']);
    Route::match(["GET", "POST"], '/cashier/delete/{id}', [$sales_builder::Cashier, 'delete']);
});



Route::prefix('admin/{token}')->middleware('ensureTokenIsValid')->group(function () { // to get to this group, access admin?token=my-secret-token
    Route::get('/', function (Request $request) {
        return view('index', ['request' => $request]);
    })->withoutMiddleware('ensureTokenIsValid');

    Route::get('/user/profile', function (Request $request) {
        return $request;
    })->middleware('role:editor');;
});



// Route::get('/user/{id}', function ($id) {
//     return 'user number: '.$id;
// });
// Route::get('/posts/{post}/comments/{comment}', function ($id1, $id2) {
//     return $id1.' &#x2800; '.$id2;
// });
// Route::get('/user/{name?}', function ($name = 'John') {
//     return $name;
// });


// Route::get('/user/{name}', function ($name) {
//     //
// })->where('name', '[A-Za-z]+');
// Route::get('/user/{id}', function ($id) {
//     //
// })->where('id', '[0-9]+');
// Route::get('/user/{id}/{name}', function ($id, $name) {
//     //
// })->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

// Route::get('/user/{id}/{name}', function ($id, $name) {
//     //
// })->whereNumber('id')->whereAlpha('name');
// Route::get('/user/{name}', function ($name) {
//     //
// })->whereAlphaNumeric('name');
// Route::get('/user/{id}', function ($id) {
//     //
// })->whereUuid('id');



/**
 * add this multiline code in App\Providers\RouteServiceProvider
 * Define your route model bindings, pattern filters, etc.
 *
 * @return void
 * 
    public function boot()
    {
        Route::pattern('id', '[0-9]+');
    }
 */
// Route::get('/user/{id}', function ($id) {
//     // Only executed if {id} is numeric...
// });

Route::get('/search/{search}', function ($search) {
    return $search;
})->where('search', '.*');

Route::get(
    '/user/profile',
    // [UserProfileController::class, 'show']
    function() {
        return 'hello.';
    }
)->name('profile1');

// Route::get('/user/profile/unknown', function() {
//     return redirect()->route('profile1');
// });

Route::get('/user/{id}/profile', function ($id) {
    return $id;
})->name('profile2');
// $url = route('profile2', ['id' => 1, 'photos' => 'yes']);

Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        // Matches The "/admin/users" URL
    });
});
Route::name('admin.')->group(function () {
    Route::get('/users', function () {
        // Route assigned name "admin.users"...
    })->name('users');
});

// route::fallback(function() {
//     return "nothing.";
// });