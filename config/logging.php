<?php

return [

    'default' => env('LOG_CHANNEL', 'stack'),

    'channels' => [

        'stack' => [

            'driver'   => 'stack',
            'channels' => ['single']
        ],

        'single' => [

            'driver' => 'single',
            'path'   => storage_path('logs/lumen.log'),
            'level'  => 'debug'
        ],

        'daily' => [

            'driver' => 'daily',
            'path'   => storage_path('logs/lumen.log'),
            'level'  => 'debug',
            'days'   => 7
        ],

        'slack' => [

            'driver'   => 'slack',
            'url'      => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Lumen Log',
            'emoji'    => ':boom:',
            'level'    => 'critical'
        ],

        'syslog' => [

            'driver' => 'syslog',
            'level'  => 'debug'
        ],

        'errorlog' => [

            'driver' => 'errorlog',
            'level'  => 'debug'
        ],

        'api' => [

            'driver' => 'single',
            'path'   => storage_path('logs/api.log')
        ]
    ]
];
