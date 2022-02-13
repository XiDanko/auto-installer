<?php

return [
    'commands' => [
        ['name' => 'optimize:clear',                'args' => []],
        ['name' => 'app:move-to-production',        'args' => []],
        ['name' => 'app:generate-autoloader',       'args' => []],
        ['name' => 'app:create-database',           'args' => []],
        ['name' => 'migrate:fresh',                 'args' => ['--seed' => true]],
        ['name' => 'storage:link',                  'args' => []],
        ['name' => 'app:set-as-default-site',       'args' => []],
        ['name' => 'optimize',                      'args' => []],
        ['name' => 'app:create-websockets-service',  'args' => []],
        ['name' => 'app:restart-host',              'args' => []],
    ]
];
