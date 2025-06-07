<?php

return [
    'services_startup_delay' => 5000,

    'commands' => [
        ['name' => 'optimize:clear',                'args' => []],
        ['name' => 'opcache:clear',                 'args' => []],
        ['name' => 'migrate',                       'args' => ['--quiet' => true]],
        ['name' => 'migrate:fresh',                 'args' => ['--seed' => true]],
        ['name' => 'storage:link',                  'args' => []],
        ['name' => 'app:set-as-default-site',       'args' => []],
        ['name' => 'app:create-scheduler-service',  'args' => []],
        ['name' => 'app:create-queue-service',      'args' => []],
        ['name' => 'optimize',                      'args' => []],
        ['name' => 'opcache:compile',               'args' => []],
//        ['name' => 'app:restart-host',              'args' => []],
    ]
];
