<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;

class InstallLaravelEchoServer extends Command
{
    protected $signature = 'app:install-echo-server';

    protected $description = 'Install laravel echo server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $this->info('Installing echo server...');
            exec("npm install -g laravel-echo-server");
            $this->info('Echo server installed successfully.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
