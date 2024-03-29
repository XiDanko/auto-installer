<?php

return [
    'services_startup_delay' => 30000,

    'roadrunner' => [
        'executable_path' => base_path('rr.exe'),
        'config_path' => base_path('.rr.yaml'),
    ],

    'commands' => [
        ['name' => 'optimize:clear',                'args' => []],
        ['name' => 'app:create-database',           'args' => []],
        ['name' => 'migrate:fresh',                 'args' => ['--seed' => true]],
        ['name' => 'storage:link',                  'args' => []],
        ['name' => 'app:set-as-default-site',       'args' => []],
        ['name' => 'app:create-scheduler-service',  'args' => []],
        ['name' => 'app:create-queue-service',      'args' => []],
        ['name' => 'app:create-websockets-service', 'args' => []],
        ['name' => 'app:create-roadrunner-service', 'args' => []],
        ['name' => 'optimize',                      'args' => []],
        ['name' => 'app:restart-host',              'args' => []],
    ]
];
