<?php

return [
    'private_key' => env('MARVEL_PRIVATE_KEY'),
    'public_key'  => '382e7fe7375556c9c88f6453ca21bd72',
    'base_uri'    => 'http://gateway.marvel.com/v1/public/',
    'cache_time'  => 1440, // 1 day
    'endpoints'   => [
        'comics'     => 'comics',
        'characters' => 'characters',
        'series'     => 'series',
    ],
    'series' => [
        'thumbnail' => 'portrait_uncanny.jpg',
    ],
    'characters'  => [
        'thumbnail' => 'portrait_incredible.jpg',
    ],
];