<?php

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@comics']);
Route::get('/comics', ['as' => 'comics', 'uses' => 'HomeController@comics']);
Route::get('/comic/{id}', ['as' => 'comic', 'uses' => 'HomeController@comic']);
Route::get('/characters', ['as' => 'characters', 'uses' => 'HomeController@characters']);
