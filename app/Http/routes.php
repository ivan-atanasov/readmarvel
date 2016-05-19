<?php

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@comics']);
Route::get('/comics', ['as' => 'comics', 'uses' => 'HomeController@comics']);
Route::get('/comics/{id}', ['as' => 'comic', 'uses' => 'HomeController@comics']);
Route::get('/characters', ['as' => 'characters', 'uses' => 'HomeController@characters']);
