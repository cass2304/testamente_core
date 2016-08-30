<?php


Route::get('/', function () {
    return view('welcome');
});

// Rutas de la API
Route::group(['middleware' => ['cors','jwt.auth']], function()
{
    Route::post('/sing_in', 'ApiAuthController@userAuth'); // Autenticado de Usuario

    Route::post('users/sing_up', 'ApiAuthController@register'); // Registro de Usuario

    Route::post('password/new', 'ApiAuthController@NewPasswd'); // Cambio de Contraseña

    Route::post('/users/delete', 'ApiAuthController@delete'); // Borra el registro de la BD

    Route::get('/users', 'ApiAuthController@index');          // Muestra la lista de Usuarios

    Route::post('/documents','documentController@update');    // Update de la tabla documents luego de siguiente

    Route::post('/documents/show','documentController@index');    // Update de la tabla documents luego de siguiente

    Route::post('/questions','aditionalQuestionController@register');

    Route::group(['prefix' => 'clients'], function () {

    Route::post('/info', 'personalController@register');      // Crea el registro

    Route::get('/show', 'personalController@show');           // Muestra El registro segun el user_id

    Route::get('/destroy', 'personalController@destroy');     // Elimna El registro segun el user_id

    Route::post('/update', 'personalController@update');      // Actualiza el registro

    });

    Route::group(['prefix' => 'family'], function () {

    Route::post('/info', 'familyController@register');      // Crea el registro

    Route::get('/show', 'familyController@show');           // Muestra El registro segun el user_id

    Route::get('/destroy', 'familyController@destroy');     // Elimna El registro segun el user_id

    Route::post('/update', 'familyController@update');      // Actualiza el registro



    });


});
