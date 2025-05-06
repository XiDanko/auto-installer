<?php

return [
    'services_startup_delay' => 5000,

    'commands' => [
        ['name' => 'optimize:clear',                'args' => []],
        ['name' => 'app:create-database',           'args' => []],
        ['name' => 'migrate:fresh',                 'args' => ['--seed' => true]],
        ['name' => 'storage:link',                  'args' => []],
        ['name' => 'app:set-as-default-site',       'args' => []],
        ['name' => 'app:create-scheduler-service',  'args' => []],
        ['name' => 'app:create-queue-service',      'args' => []],
        ['name' => 'app:create-octane-service',     'args' => []],
        ['name' => 'optimize',                      'args' => []],
        ['name' => 'app:restart-host',              'args' => []],
    ]
];
