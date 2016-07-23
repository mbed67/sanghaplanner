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

Route::get('sanghas/{id}/members',[
        'middleware' => 'memberOfSangha',
        'as' => 'get_sangha_members_path',
        'uses' => 'SanghasController@getMembersForSangha'
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

Route::get('membership/{sanghaIdToLeave}', [
        'as' => 'leave_sangha_path',
        'uses' => 'MembershipsController@destroy'
        ]);

Route::post('updatemembership', [
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

Route::get('notifications/{sanghaId}', [
    'as' => 'fetch_notifications_for_sangha_path',
    'uses' => 'NotificationsController@fetchNotificationsForSangha'
]);


/**
 * Retreats
 */
Route::resource('sanghas.retreats', 'SanghaRetreatController');


/**
 * Tasks
 */
Route::resource('sanghas.retreats.tasks', 'TasksController');
