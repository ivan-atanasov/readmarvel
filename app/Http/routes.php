<?php

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@comics']);
    Route::get('/comics', ['as' => 'comics', 'uses' => 'HomeController@comics']);
    Route::get('/comic/{id}', ['as' => 'comic', 'uses' => 'HomeController@comic']);
    Route::get('/characters', ['as' => 'characters', 'uses' => 'HomeController@characters']);
});

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);

    Route::group(['prefix' => 'login'], function () {
        Route::get('/', ['as' => 'login_index', 'uses' => 'AuthController@getLogin']);
        Route::post('/', ['as' => 'login', 'uses' => 'AuthController@postLogin']);
    });

    Route::group(['prefix' => 'register'], function () {
        Route::get('/', ['as' => 'register_index', 'uses' => 'AuthController@getRegister']);
        Route::post('/', ['as' => 'register', 'uses' => 'AuthController@postRegister']);
    });
});
