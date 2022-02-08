<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;

class MoveToProduction extends Command
{
    protected $signature = 'app:move-to-production';

    protected $description = 'Change application environment to production';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $this->info('Moving to production...');
            copy(base_path('.env.prod'), base_path('.env'));
            $this->info('Moving to production done successfully.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
