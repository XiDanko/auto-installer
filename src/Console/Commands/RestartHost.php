<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;
use PHPUnit\Exception;

class RestartHost extends Command
{
    protected $signature = 'app:restart-host';

    protected $description = 'Restart host server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $this->info('Sending restart request...');
            exec('shutdown /r /c "System will restart within 30 seconds to apply changes."');
            $this->info('Restart request sent successfully.');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
