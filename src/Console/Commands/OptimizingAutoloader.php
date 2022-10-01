<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;

class OptimizingAutoloader extends Command
{
    protected $signature = 'app:optimize-autoloader';

    protected $description = 'Optimizing composer autoloader';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $this->info('Optimizing autoloader...');
            exec('composer install --no-dev --optimize-autoloader --no-interaction --working-dir ' . base_path());
            $this->info('Autoloader optimized successfully.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
