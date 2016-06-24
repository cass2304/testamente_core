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

// Rutas de la API
Route::group(['middleware' => 'cors'], function()
{
    Route::post('/sing_in', 'ApiAuthController@userAuth'); // Autenticado de Usuario

    Route::post('users/sing_up', 'ApiAuthController@register'); // Registro de Usuario

    Route::get('/users', 'ApiAuthController@index');          // Muestra la lista de Usuarios

});



