<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::auth();

//Login routes
Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);

// Registration Routes...
Route::get('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@showRegistrationForm']);
Route::post('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@register']);

// Password Reset Routes...
Route::get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@showResetForm']);
Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@reset']);

//Ruta para eliminar cuenta
Route::get('logout/delete', ['as' => 'auth.logout.delete', 'uses' => 'Auth\AuthController@deleteForm']);
Route::post('logout/delete', ['as' => 'auth.logout.delete', 'uses' => 'Auth\AuthController@logoutAndDelete']);

//Ruta para Editar la cuenta
Route::get('edit',['as'=>'auth.edit','uses'=>'CuentasController@edit']);
Route::put('edit/per',['as'=>'auth.edit.per','uses'=>'CuentasController@editInformacionPersonal']);
Route::put('edit/pass',['as'=>'auth.edit.pass','uses'=>'CuentasController@editPassword']);
// Route::post('edit',['as'=>'auth.edit','uses'=>'CuentasController@editInformacionPersonal']);

