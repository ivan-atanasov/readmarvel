<?php

Route::get('/c3.php', function () {
    include '../../c3.php';
});

/**
 * -------------------------------------------------
 * Frontend Routes
 * -------------------------------------------------
 */
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('/series', ['as' => 'frontend.series', 'uses' => 'SeriesController@list']);
    Route::get('/series/search', ['as' => 'frontend.series.search', 'uses' => 'SeriesController@search']);
    Route::get('/series/{id}', ['as' => 'frontend.series.show', 'uses' => 'SeriesController@show']);

    Route::get('password/email', ['as' => 'reset_password_index', 'uses' => 'Auth\PasswordController@getEmail']);
    Route::post('password/email', ['as' => 'reset_password', 'uses' => 'Auth\PasswordController@postEmail']);
    Route::get('password/reset/{token}', ['as' => 'frontend.email_reset_token', 'uses' => 'Auth\PasswordController@getReset']);
    Route::post('password/reset', ['as' => 'frontend.email_reset', 'uses' => 'Auth\PasswordController@postReset']);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', ['as' => 'frontend.profile', 'uses' => 'ProfileController@index']);
        Route::post('/profile', ['as' => 'frontend.update_profile', 'uses' => 'ProfileController@update']);
        Route::get('/profile/list/{id}', ['as' => 'frontend.profile_view_list', 'uses' => 'ProfileController@viewList']);
        Route::post('/update_avatar', ['as' => 'frontend.update_avatar', 'uses' => 'ProfileController@updateAvatar']);
        Route::post('/list/store', ['as' => 'frontend.store_list', 'uses' => 'ListController@store']);
        Route::post('/list/update_avatar', ['as' => 'frontend.update_list_avatar', 'uses' => 'ListController@updateListAvatar']);
        Route::post('series/series', ['as' => 'frontend.get_series_json', 'uses' => 'SeriesController@seriesJson']);
        Route::post(
            '/list/addItemToList',
            [
                'as'   => 'frontend.add_item_to_list',
                'uses' => 'ListController@addItemToList',
            ]
        );

        Route::post(
            '/list/updateItemInList',
            [
                'as'   => 'frontend.update_item_in_list',
                'uses' => 'ListController@updateItemInList',
            ]
        );

        Route::post(
            '/list/deleteItemFromList',
            [
                'as'   => 'frontend.delete_from_list',
                'uses' => 'ListController@deleteItemFromList',
            ]
        );
    });
});


/**
 * -------------------------------------------------
 * Admin Routes
 * -------------------------------------------------
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
        Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
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
        Route::post('/', ['as' => 'register_post', 'uses' => 'AuthController@postRegister']);
    });
});
