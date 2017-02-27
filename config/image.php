<?php

return [
    'driver'             => 'gd',
    'upload_path'        => '/public/uploads/images',
    'image_path'         => '/uploads/images',
    'default_avatar'     => '/images/default_avatar_150_150.jpg',
    'default_profile_bg' => '/images/default_profile_bg.jpg',
    'default_list'       => '/images/default_list_150_150.png',
    'default_list_bg'    => '/images/default_profile_bg.jpg',

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
