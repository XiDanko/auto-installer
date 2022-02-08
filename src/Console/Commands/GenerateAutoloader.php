<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;

class GenerateAutoloader extends Command
{
    protected $signature = 'app:generate-autoloader';

    protected $description = 'Regenerate composer autoloader';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $this->info('Generating autoloader...');
            exec('composer dump-autoload -d ' . base_path());
            $this->info('Autoloader generated successfully.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
