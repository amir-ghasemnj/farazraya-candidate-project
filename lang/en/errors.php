<?php

return [
    'unauthenticated' => 'please login first.',
    'unauthorized' => 'access denied.',
    'limiter' => 'please try again after :seconds seconds.',
    'unexpected' => 'unexpected error occurred.',
    'user' => [
        'auth' => [
            'invalid_credentials' => [
                'message' => 'maybe email/password was incorrect.',
                'code' => '100000',
            ],
        ],
        'etc' => [
            '404' => [
                'message' => 'user not found.',
                'code' => '110000',
            ]
        ]
    ],
    'room' => [
        'capacity' => [
            'message' => 'room capacity is full.',
            'code' => '120000',
        ],
        '404' => [
            'message' => 'room not found.',
            'code' => '120001',
        ],
    ]
];