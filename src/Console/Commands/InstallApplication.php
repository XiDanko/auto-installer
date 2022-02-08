<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;

class InstallApplication extends Command
{
    protected $signature = 'app:install';

    protected $description = 'Handle all the operations required to install the application';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        foreach (config('auto-installer.commands') as $command) {
            $this->call($command['name'], $command['args']);
            $this->warn('===================================================');
        }
    }
}
