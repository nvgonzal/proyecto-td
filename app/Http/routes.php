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
Route::group(['middleware' => 'auth'], function () {
    Route::get('edit', ['as' => 'auth.edit', 'uses' => 'CuentasController@edit']);
    Route::put('edit/per', ['as' => 'auth.edit.per', 'uses' => 'CuentasController@editInformacionPersonal']);
    Route::put('edit/pass', ['as' => 'auth.edit.pass', 'uses' => 'CuentasController@editPassword']);
    Route::put('edit/cue', ['as' => 'auth.edit.cue', 'uses' => 'CuentasController@editInformacionCuenta']);
    Route::put('edit/img', ['as' => 'auth.edit.img', 'uses' => 'CuentasController@editImagen']);
});

Route::group(['prefix' => 'transportista', 'middleware' => ['auth', 'tran']], function () {
    //Rutas para CRUD de vehiculo
    Route::get('mis-vehiculos/', ['as' => 'vehiculos', 'uses' => 'VehiculoController@index']);
    Route::get('mis-vehiculos/create', ['as' => 'vehiculos.create', 'uses' => 'VehiculoController@create']);
    Route::get('mis-vehiculos/{id}', ['as' => 'vehiculos.show', 'uses' => 'VehiculoController@show']);

    Route::get('envios', ['as' => 'envios', 'uses' => 'TransportistaController@verEnvios']);
    Route::get('envios/reg/{id}', [
        'as' => 'envios.reg',
        'uses' => 'TransportistaController@tomarEnvio',
        'middleware' => ['deletable', 'takable']]);
    Route::get('envios/taken', ['as' => 'envios.taken', 'uses' => 'TransportistaController@verEnviosTomados']);
    Route::get('envios/undo/{id}', [
        'as' => 'envios.undo',
        'uses' => 'TransportistaController@cancelarSolicitud',
        'middleware' => ['deletable', 'takable']]);

    Route::get('envio/{id}/rate', ['as' => 'envio.rate.cli', 'uses' => 'TransportistaController@evaluar', 'middleware' => ['rateable', 'traev']]);
    Route::put('envio/{id}/rate', [
        'as' => 'envio.rate.cli',
        'uses' => 'TransportistaController@registrarEvaluacion',
        'middleware' => ['rateable', 'traev'],
    ]);

    Route::get('envios/fin', ['as' => 'envios.fin', 'uses' => 'TransportistaController@enviosFinalizados']);
});

Route::group(['prefix' => 'cliente', 'middleware' => ['auth', 'cli']], function () {
    //grupo de rutas de crud de envio
    Route::get('verhistorial',['as'=>'envio.verhistorial','uses'=>'EnvioController@index']);
    Route::get('envio/create/', ['as' => 'envio.create', 'uses' => 'EnvioController@create']);
    Route::post('envio/create/', ['as' => 'envio.store', 'uses' => 'EnvioController@store']);
    Route::get('envio/edit/{id}', ['as' => 'envio.edit', 'uses' => 'EnvioController@edit', 'middleware' => ['envi', 'editable']]);
    Route::put('envio/edit/{id}', ['as' => 'envio.edit', 'uses' => 'EnvioController@update', 'middleware' => ['envi', 'editable']]);
    Route::get('envio/delete/{id}', [
        'as' => 'envio.delete',
        'uses' => 'EnvioController@destroy',
        'middleware' => ['envi', 'deletable']]);

    Route::get('verhistorial/asignados', ['as' => 'envio.asignados', 'uses' => 'EnvioController@enviosAsignados']);
    Route::get('verhistorial/activos', ['as' => 'envio.activos', 'uses' => 'EnvioController@enviosActivos']);
    Route::get('verhistorial/finalizados', ['as' => 'envio.fin', 'uses' => 'EnvioController@enviosFinalizados']);

    Route::get('envio/solicitudes/{id}', [
        'as' => 'envio.solicitudes',
        'uses' => 'EnvioController@verSolicitudes',
        'middleware' => 'envi']);

    Route::get('envio/solicitudes/{id}/acep/{tra}',
        ['as' => 'envio.aceptar', 'uses' => 'EnvioController@aceptarSolicitud', 'middleware' => 'envi']);

    Route::get('envio/finalizar/{id}', ['as' => 'envio.finalizar', 'uses' => 'EnvioController@finalizarEnvio',
        'middleware' => 'envi']);

    Route::get('envio/{id}/rate', ['as' => 'envio.rate.tra', 'uses' => 'EnvioController@evaluar', 'middleware' => ['envi', 'rateable']]);
    Route::put('envio/{id}/rate', [
        'as' => 'envio.rate.tra',
        'uses' => 'EnvioController@registrarEvaluacion',
        'middleware' => ['envi', 'rateable']]);
});

Route::get('cliente/envio/{id}', ['as' => 'envio.show', 'uses' => 'EnvioController@show']);

Route::get('cuenta/info/{id}', ['as' => 'cuenta.info', 'uses' => 'CuentasController@show']);
Route::get('cuentas', ['as' => 'cuentas', 'uses' => 'CuentasController@index']);


Route::get('empresa/{id}', ['as' => 'empresa.show', 'uses' => 'EmpresaController@show']);