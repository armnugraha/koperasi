<?php

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

Route::auth();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function () {

	Route::resource('/', 'HomeController');
	Route::resource('/transactions', 'TransactionController');
	Route::resource('/products', 'ProductController');
	Route::resource('/users', 'UserController');

});
