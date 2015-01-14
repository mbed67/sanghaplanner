<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::when('*', 'csrf', array('post', 'put', 'delete'));

Route::get('/', [
	'as' => 'home',
	'uses' => 'PagesController@home'
]);

/**
 * Registration!
 */
Route::get('register', [
	'as' => 'register_path',
	'uses' => 'RegistrationController@create'
]);

Route::post('register', [
	'as' => 'register_path',
	'uses' => 'RegistrationController@store'
]);

/**
 * Sessions
 */
Route::get('login', [
	'as' => 'login_path',
	'uses' => 'SessionsController@create'
]);

Route::post('login', [
	'as' => 'login_path',
	'uses' => 'SessionsController@store'
]);

Route::get('logout', [
	'as' => 'logout_path',
	'uses' => 'SessionsController@destroy'
	]);

/**
 * Users
 */
Route::get('users', [
		'as' => 'users_path',
		'uses' => 'UsersController@index'
		]);

Route::get('users/{id}', [
		'as' => 'profile_path',
		'uses' => 'UsersController@show'
		]);


/**
 * Password resets
 */
Route::controller('password', 'RemindersController');


/**
 * Sanghas
 */
Route::get('sanghas', [
		'as' => 'sanghas_path',
		'uses' => 'SanghasController@index'
		]);


Route::get('createsangha', [
		'as' => 'createsangha_path',
		'uses' => 'SanghasController@create'
		]);

Route::post('createsangha', [
		'as' => 'createsangha_path',
		'uses' => 'SanghasController@store'
		]);

Route::get('sanghas/{id}', [
		'as' => 'sanghadetails_path',
		'uses' => 'SanghasController@show'
		]);

Route::put('sanghas/{id}', [
		'before' => 'adminForSangha',
		'as' => 'sanghadetails_path',
		'uses' => 'SanghasController@update'
		]);


/**
 * Roles
 */
Route::get('roles', [
		'as' => 'roles_path',
		'uses' => 'RolesController@index'
		]);


Route::get('createrole', [
		'as' => 'createrole_path',
		'uses' => 'RolesController@create'
		]);

Route::post('createrole', [
		'as' => 'createrole_path',
		'uses' => 'RolesController@store'
		]);
