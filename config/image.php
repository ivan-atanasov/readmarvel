<?php

return [
    'driver'      => 'gd',
    'upload_path' => '/public/uploads/images',
    'image_path'  => '/uploads/images',

    'profile' => [
        'small'  => [
            'w' => 50,
            'h' => 50,
        ],
        'medium' => [
            'w' => 150,
            'h' => 150,
        ],
        'large'  => [
            'w' => 350,
            'h' => 350,
        ],
    ],
];
