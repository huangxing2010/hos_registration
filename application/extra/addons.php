<?php

return [
    'autoload' => false,
    'hooks' => [
        'app_init' => [
            'epay',
        ],
        'upgrade' => [
            'registration',
        ],
        'user_sidenav_after' => [
            'signin',
        ],
    ],
    'route' => [],
    'priority' => [],
    'domain' => '',
];
