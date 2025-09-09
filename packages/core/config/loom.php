<?php

return [
    'defaults' => [
        'panel' => [
            'id' => env('PANEL_ID', 'app'),
        ],
    ],

    'panels' => [
        'app' => [
            'id' => env('PANEL_ID', 'app'),
            'path' => env('PANEL_PATH', 'app'),
            'auth_guard' => env('AUTH_GUARD', 'web'),
        ],

        'admin' => [
            'id' => env('ADMIN_PANEL_ID', 'admin'),
            'path' => env('ADMIN_PANEL_PATH', 'admin'),
            'auth_guard' => env('ADMIN_AUTH_GUARD', 'admin'),
        ],
    ],

    'components' => [
        'file' => [
            'disk' => 'public',
            'max_size' => 2048,
        ],
        'image' => [
            'directory' => 'images',
            'resize_mode' => 'cover',
            'crop_aspect_ratio' => '1:1',
        ],
        'avatar' => [
            'directory' => 'images/avatars',
        ],
    ],
];
