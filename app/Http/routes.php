<?php

Route::get('/', 'HomeController@comics');
Route::get('/comics', 'HomeController@comics');
Route::get('/comics/{id}', 'HomeController@comic');
Route::get('/characters', 'HomeController@characters');
