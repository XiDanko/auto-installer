<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;

class CreateDatabase extends Command
{
    protected $signature = 'app:create-database';

    protected $description = 'Create application database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $this->info('Creating database...');
            $mysql = new \mysqli(env('db_host') . ':' . env('db_port'), env('db_username'), env('db_password'));
            $mysql->query('CREATE DATABASE ' . env('db_database') . ' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
            $this->info('Database created successfully.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
