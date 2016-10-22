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

Route::get('/home', function(){
  return redirect(route('home'));
});

/**
 * Auth
 */

Route::controller('password', 'Auth\PasswordController');

Route::get('/login', ['as' => 'auth/login', 'uses' => 'Auth\AuthController@getLogin']);

Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::get('/register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@getRegister']);

Route::post('/register', 'Auth\AuthController@postRegister');

Route::get('/forgot', ['as' => 'auth/forgot', 'uses' => 'Auth\PasswordController@getForgot']);

Route::post('/forgot', ['as' => 'auth/forgot', 'uses' => 'Auth\PasswordController@postEmail']);

Route::get('/reset', ['as' => 'auth/reset/{token}', 'uses' => 'Auth\PasswordController@getReset']);

Route::post('/reset', ['as' => 'auth/reset', 'uses' => 'Auth\PasswordController@postReset']);

Route::any('/validate-email', ['as' => 'auth/validate-email', 'uses' => 'Auth\AuthController@validateEmail']);

/**
 * Rutas de aplicacion
 * Namespace: Viaticos
 * NOTA: se debe manejar roles de usuarios para el ACL en el enrutador
 */

Route::group(['namespace' => 'Viaticos', 'prefix' => 'viaticos', 'middleware' => ['auth']], function(){

  /**
   * Rutas generales
   */
  Route::get('/', ['as' => '/', 'uses' => 'HomeController@home']);
  Route::get('/dashboard', ['as' => 'viaticos/dashboard', 'uses' => 'HomeController@dashboard']);
  Route::get('/home', ['as' => 'viaticos/home', 'uses' => 'HomeController@home']);

  /**
   * Usuarios
   */
  Route::controller('usuarios', 'UsuariosController');


  /**
   * Cuentas
   */
  Route::controller('cuentas', 'CuentasController');
  Route::controller('plan_cuentas', 'PlanCuentasController');

  /**
   * Solicitudes
   */
  Route::get('solicitudes/mis-solicitudes', ['uses' => 'SolicitudesController@getListadoSolicitudesUsuario']);

  Route::controller('solicitudes', 'SolicitudesController');

  /**
   * Areas
   */
  Route::controller('areas', 'AreasController');

});
