<?php
/**
 * Required by codeception to run tests with code coverage
 * The c3.php file is copied when composer install runs
 */
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

    /**
     * Series
     */
    Route::get('/series', ['as' => 'frontend.series', 'uses' => 'SeriesController@list']);
    Route::get('/series/search', ['as' => 'frontend.series.search', 'uses' => 'SeriesController@search']);
    Route::get('/series/{id}/{url_slug?}', ['as' => 'frontend.series.show', 'uses' => 'SeriesController@show']);

    /**
     * Favourite Characters
     */
    Route::get(
        '/characters/favourite/{character_id}',
        ['as' => 'frontend.characters.favourite', 'uses' => 'FavouriteCharactersController@favourite']
    );
    Route::get(
        '/characters/unfavourite/{character_id}',
        ['as' => 'frontend.characters.unfavourite', 'uses' => 'FavouriteCharactersController@unfavourite']
    );

    /**
     * Characters
     */
    Route::get('/characters', ['as' => 'frontend.characters', 'uses' => 'CharactersController@list']);
    Route::get('/characters/search', ['as' => 'frontend.characters.search', 'uses' => 'CharactersController@search']);

    Route::get(
        '/characters/{id}/{url_slug?}',
        ['as' => 'frontend.characters.show', 'uses' => 'CharactersController@show']
    );

    /**
     * Public Lists
     */
    Route::get('/lists/{list_hash}', ['as' => 'frontend.lists.public', 'uses' => 'PublicListsController@show']);

    /**
     * Password Reset
     */
    Route::get('password/email', ['as' => 'reset_password_index', 'uses' => 'Auth\PasswordController@getEmail']);
    Route::post('password/email', ['as' => 'reset_password', 'uses' => 'Auth\PasswordController@postEmail']);
    Route::get(
        'password/reset/{token}',
        ['as' => 'frontend.email_reset_token', 'uses' => 'Auth\PasswordController@getReset']
    );
    Route::post('password/reset', ['as' => 'frontend.email_reset', 'uses' => 'Auth\PasswordController@postReset']);

    /**
     * Static Pages
     */
    Route::get('page/{url_slug}', ['as' => 'frontend.static', 'uses' => 'StaticPagesController@show']);
    Route::get('contact', ['as' => 'frontend.contact', 'uses' => 'HomeController@contact']);
    Route::post('contact', ['as' => 'frontend.contact', 'uses' => 'HomeController@sendContactFormMail']);

    /**
     * Public profile
     */
    Route::get('profile/{nickname}',
        ['as' => 'frontend.public_profile', 'uses' => 'ProfileController@publicProfile']
    );

    /**
     * Authenticated Routes
     */
    Route::group(['middleware' => 'auth'], function () {
        /**
         * Profile
         */
        Route::get('/profile', ['as' => 'frontend.profile', 'uses' => 'ProfileController@index']);
        Route::post('/profile', ['as' => 'frontend.update_profile', 'uses' => 'ProfileController@update']);
        Route::get(
            '/profile/list/{id}',
            ['as' => 'frontend.profile_view_list', 'uses' => 'ProfileController@viewList']
        );
        Route::post(
            '/update_avatar',
            ['as' => 'frontend.update_avatar', 'uses' => 'ProfileController@updateAvatar']
        );

        /**
         * Manage Lists
         */
        Route::post('/list/store', ['as' => 'frontend.store_list', 'uses' => 'ListController@store']);
        Route::post(
            '/list/update_avatar',
            ['as' => 'frontend.update_list_avatar', 'uses' => 'ListController@updateListAvatar']
        );
        Route::post('series/series', ['as' => 'frontend.get_series_json', 'uses' => 'SeriesController@seriesJson']);
        Route::post(
            '/list/addItemToList',
            ['as' => 'frontend.add_item_to_list', 'uses' => 'ListController@addItemToList']
        );

        Route::post(
            '/list/updateItemInList',
            ['as' => 'frontend.update_item_in_list', 'uses' => 'ListController@updateItemInList']
        );

        Route::post(
            '/list/deleteItemFromList',
            ['as' => 'frontend.delete_from_list', 'uses' => 'ListController@deleteItemFromList']
        );

        /**
         * Comments
         */
        Route::post('comments/store', ['as' => 'frontend.comments.store', 'uses' => 'CommentsController@store']);

    });
});

/**
 * -------------------------------------------------
 * Admin Routes
 * -------------------------------------------------
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth.admin'], function () {
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);

    Route::resource('static', 'StaticPagesController');
    Route::resource('users', 'UsersController');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('change-password', ['as' => 'admin.change_password', 'uses' => 'ProfileController@changePassword']);
        Route::post(
            'change-password',
            ['as' => 'admin.change_password_post', 'uses' => 'ProfileController@changePasswordPost']
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
        Route::post('/', ['as' => 'register_post', 'uses' => 'AuthController@postRegister']);
    });
});
