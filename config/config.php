<?php

return [
    'service_startup_delay' => 30000,
    'commands' => [
        ['name' => 'app:generate-autoloader',       'args' => []],
        ['name' => 'optimize:clear',                'args' => []],
        ['name' => 'app:move-to-production',        'args' => []],
        ['name' => 'app:create-database',           'args' => []],
        ['name' => 'migrate:fresh',                 'args' => ['--seed' => true]],
        ['name' => 'storage:link',                  'args' => []],
        ['name' => 'app:set-as-default-site',       'args' => []],
        ['name' => 'app:create-websockets-service', 'args' => []],
        ['name' => 'optimize',                      'args' => []],
        ['name' => 'app:restart-host',              'args' => []],
    ]
];
