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
Route::put('edit/cue',['as'=>'auth.edit.cue','uses'=>'CuentasController@editInformacionCuenta']);

Route::group(['prefix' => 'transportista', 'middleware' => ['tran', 'auth']], function () {
    //Rutas para CRUD de vehiculo
    Route::get('mis-vehiculos/', ['as' => 'vehiculos', 'uses' => 'VehiculoController@index']);
    Route::get('mis-vehiculos/create', ['as' => 'vehiculos.create', 'uses' => 'VehiculoController@create']);
    Route::get('mis-vehiculos/{id}', ['as' => 'vehiculos.show', 'uses' => 'VehiculoController@show']);

    Route::get('envios', ['as' => 'envios', 'uses' => 'TransportistaController@verEnvios']);
    Route::get('envios/reg/{id}', ['as' => 'envios.reg', 'uses' => 'TransportistaController@tomarEnvio']);
    Route::get('envios/taken', ['as' => 'envios.taken', 'uses' => 'TransportistaController@verEnviosTomados']);
    Route::get('envios/undo/{id}', ['as' => 'envios.undo', 'uses' => 'TransportistaController@cancelarSolicitud']);
});

Route::group(['prefix' => 'cliente', 'middleware' => ['auth', 'cli']], function () {
    //grupo de rutas de crud de envio
    Route::get('verhistorial',['as'=>'envio.verhistorial','uses'=>'EnvioController@index']);
    Route::get('envio/create/', ['as' => 'envio.create', 'uses' => 'EnvioController@create']);
    Route::post('envio/create/', ['as' => 'envio.store', 'uses' => 'EnvioController@store']);
    Route::get('envio/edit/{id}',['as' => 'envio.edit', 'uses' => 'EnvioController@edit']);
    Route::put('envio/edit/{id}',['as' => 'envio.edit', 'uses' => 'EnvioController@update']);
    Route::get('envio/delete/{id}',['as' => 'envio.delete', 'uses' => 'EnvioController@destroy']);

    Route::get('envio/solicitudes/{id}', ['as' => 'envio.solicitudes', 'uses' => 'EnvioController@verSolicitudes']);
    Route::get('envio/solicitudes/{id}/acep/{tra}', ['as' => 'envio.aceptar', 'uses' => 'EnvioController@aceptarSolicitud']);
});

Route::get('cliente/envio/{id}', ['as' => 'envio.show', 'uses' => 'EnvioController@show']);

Route::get('cuenta/info/{id}', ['as' => 'cuenta.info', 'uses' => 'CuentasController@show']);
Route::get('cuentas', ['as' => 'cuentas', 'uses' => 'CuentasController@index']);

//Route::get('empresa/{id}',[]);