<?php

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

// We want to use specific routes not the full authentication
Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});
// Auth::routes();

Route::get('/', 'PostController@index')->name('home');
Route::get('/{slug}', 'PostController@show')->name('posts.show');
Route::get('/category/{slug}', 'PostController@category')->name('posts.category');
Route::get('/user/{id}', 'PostController@user')->name('posts.user');

Route::resource('comments', 'CommentController')->only(['store']);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::resource('posts', 'PostController')->except(['show']);
});
