<?php

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@comics']);
    Route::get('/comics', ['as' => 'frontend.comics', 'uses' => 'HomeController@comics']);
    Route::get('/comic/{id}', ['as' => 'frontend.comic', 'uses' => 'HomeController@comic']);
    Route::get('/characters', ['as' => 'frontend.characters', 'uses' => 'HomeController@characters']);

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/profile', ['as' => 'frontend.profile', 'uses' => 'ProfileController@index']);
        Route::post('/profile', ['as' => 'frontend.update_profile', 'uses' => 'ProfileController@update']);
    });
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
