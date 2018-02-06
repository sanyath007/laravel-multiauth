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

Route::get('/', function () {
    // return view('welcome'); //set view to laravel app
    return view('index'); 	//set view to angularjs app
});

Route::get('/welcome', function() {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/{provider}', 'Auth\RegisterController@redirectToProvider');

Route::get('login/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

Route::group([
	'middleware' 	=> 'api',
	'prefix'	 	=> 'api',
], function($router) {
	Route::get('users', 'UserController@index');
	Route::post('login', 'Auth\AuthenticateController@tokenAuth');
});
