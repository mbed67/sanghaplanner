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

Route::get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home'
]);

Route::get('home', 'HomeController@index');


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

Route::get('users/{id}/edit', [
        'middleware' => 'ownerOfProfile',
        'as' => 'edit_profile_path',
        'uses' => 'UsersController@edit'
        ]);

Route::put('users/{id}', [
        'middleware' => 'ownerOfProfile',
        'as' => 'update_profile_path',
        'uses' => 'UsersController@update'
        ]);

/**
 * Authentication and Password resets
 */
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


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

Route::get('sanghas/{id}/edit', [
        'middleware' => 'adminForSangha',
        'as' => 'edit_sangha_path',
        'uses' => 'SanghasController@edit'
        ]);

Route::post('sanghas/{id}', [
        'middleware' => 'adminForSangha',
        'as' => 'update_sangha_path',
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


/**
 * Memberships
 */

Route::post('membership', [
        'as' => 'memberships_path',
        'uses' => 'MembershipsController@store'
        ]);

Route::delete('membership/{id}', [
        'as' => 'membership_path',
        'uses' => 'MembershipsController@destroy'
        ]);

Route::put('updatemembership', [
        'as' => 'updatemembership_path',
        'uses' => 'MembershipsController@update'
        ]);

/**
 * Notifications
 */
Route::get('notifications', [
        'as' => 'notifications_path',
        'uses' => 'NotificationsController@index'
        ]);

Route::post('notifications', [
        'as' => 'notifications_path',
        'uses' => 'NotificationsController@store'
        ]);

/**
 * Retreats
 */
Route::resource('sanghas.retreats', 'SanghaRetreatController');


/**
 * Tasks
 */
Route::resource('sanghas.retreats.tasks', 'TasksController');
