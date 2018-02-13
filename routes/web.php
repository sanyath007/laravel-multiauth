<?php

/** ============= CORS ============= */
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Accept, Authorization, Content-Type, Origin, X-Requested-With, X-Auth-Token, X-Xsrf-Token');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 3600');
header('Content-Type: application/json;charset=utf-8');
/** ============= CORS ============= */

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
    // return view('/welcome'); //set view to laravel app
    return view('/index'); 	//set view to angularjs app
});

Route::get('/welcome', function() {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/{provider}', 'Auth\RegisterController@redirectToProvider');

Route::get('/login/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

Route::get('/verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst');

Route::get('/verified/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::group([
	// 'middleware' 	=> 'api',
	'prefix'	 	=> 'api',
], function($router) {
	Route::get('/users', 'UserController@index');
	Route::post('/login', 'Auth\AuthenticateController@tokenAuth');

	Route::get('/employee', 'EmployeeController@index');
	Route::get('/employee/{id}', 'EmployeeController@show');
	Route::get('/employee/new', 'EmployeeController@create');
	Route::post('/employee', 'EmployeeController@store');
	Route::get('/employee/{id}/edit', 'EmployeeController@edit');
	Route::put('/employee/{id}', 'EmployeeController@update');
	Route::delete('/employee/{id}', 'EmployeeController@delete');
});

