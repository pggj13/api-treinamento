<?php

$version = "V1";

Route::get('/', function () {
    echo "API rodando";
});


Route::group(['middleware' => ['api'], 'prefix' => $version], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('validations/exists', 'Validations\ValidationController@exists');
    Route::post('validations/unique', 'Validations\ValidationController@unique');
});

Route::group(['middleware' => ['auth'], 'prefix' => $version], function () {

    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::get('validate', 'Auth\AuthController@validateJwt');


    Route::get('teste', 'HomeController@teste');
    Route::apiResource('users', 'UserController');




    
});
