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

Route::get('/', ['as' => 'principal', 'uses' => 'BackController@index']);
Route::resource('login', 'LoginController');
Route::resource('usuarios', 'UserController');
Route::resource('mensajes', 'MensajesController');

Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
Route::get('restaurar-contrasena', ['as' => 'restaurarContrasena', 'uses' =>'LoginController@changePassword']);
Route::post('postChangePassword', ['as' => 'postChangePassword', 'uses' =>'LoginController@postChangePassword']);
Route::get('/selectUsuario/{id}', ['as' => 'selectusuario', 'uses' => 'LoginController@preguntaUsuarioSeleccionado']);
Route::get('/nueva-contrasena/{id}', ['as' => 'nuevaContrasena', 'uses' =>'LoginController@nuevoPassword']);
Route::post('postNewPassword', ['as' => 'postNewPassword', 'uses' =>'LoginController@postNewPassword']);

Route::post('/httpush', ['as' => 'httpush', 'uses' => 'BackController@httpush']);
Route::post('/messages', ['as' => 'messages', 'uses' => 'BackController@mensajes']);
Route::get('/editar-configuracion', ['as' => 'editarConfiguracion', 'uses' =>'BackController@editConfiguracion']);
Route::put('editar-configuracion', ['as' => 'postEditarConfiguracion', 'uses' =>'BackController@updateConfiguracion']);
