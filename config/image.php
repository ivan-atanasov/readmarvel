<?php

return [
    'driver'         => 'gd',
    'upload_path'    => '/public/uploads/images',
    'image_path'     => '/uploads/images',
    'default_avatar' => '/images/marvel_100_100.png',
    'default_logo'   => '/images/marvel_read.png',

    'profile' => [
        'small'  => [
            'w' => 50,
            'h' => 50,
        ],
        'medium' => [
            'w' => 100,
            'h' => 100,
        ],
        'large'  => [
            'w' => 850,
            'h' => 280,
        ],
    ],

    'list' => [
        'small'  => [
            'w' => 130,
            'h' => 130,
        ],
        'medium' => [
            'w' => 200,
            'h' => 200,
        ],
        'large'  => [
            'w' => 850,
            'h' => 280,
        ],
    ],
];
