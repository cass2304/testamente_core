<?php


Route::get('/', function () {
    return view('welcome');
});

// Rutas de la API
Route::group(['middleware' => 'cors'], function()
{
    Route::post('/sing_in', 'ApiAuthController@userAuth'); // Autenticado de Usuario

    Route::post('users/sing_up', 'ApiAuthController@register'); // Registro de Usuario

     Route::post('password/new', 'ApiAuthController@NewPasswd'); // Cambio de Contraseña

      Route::post('/users/delete', 'ApiAuthController@delete'); // Borra el registro de la BD

    Route::get('/users', 'ApiAuthController@index');          // Muestra la lista de Usuarios

});



