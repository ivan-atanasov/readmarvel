<?php

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('/comics', ['as' => 'frontend.comics', 'uses' => 'HomeController@comics']);
    Route::get('/comic/{id}', ['as' => 'frontend.comic', 'uses' => 'HomeController@comic']);
    Route::get('/series/{id}', ['as' => 'frontend.series', 'uses' => 'HomeController@series']);
    Route::get('/characters', ['as' => 'frontend.characters', 'uses' => 'HomeController@characters']);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', ['as' => 'frontend.profile', 'uses' => 'ProfileController@index']);
        Route::post('/profile', ['as' => 'frontend.update_profile', 'uses' => 'ProfileController@update']);
        Route::post('/update_avatar', ['as' => 'frontend.update_avatar', 'uses' => 'ProfileController@updateAvatar']);
        Route::post('/list/store', ['as' => 'frontend.store_list', 'uses' => 'ListController@store']);
        Route::post(
            '/list/addItemToList',
            [
                'as'   => 'frontend.add_item_to_list',
                'uses' => 'ListController@addItemToList',
            ]
        );
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
