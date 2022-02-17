<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class CreateWebsocketsService extends Command
{
    protected $signature = 'app:create-websockets-service';

    protected $description = 'Create websockets service';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $appName = env('app_name');
        try {
            $this->info('Creating websockets service...');
            $service = $this->generateServiceCode();
            $target = $_SERVER['USERPROFILE'] . "/AppData/Roaming/Microsoft/Windows/Start Menu/Programs/Startup/$appName-websockets-service.vbs";
            $handler = fopen($target, 'w');
            fwrite($handler, $service);
            fclose($handler);
            $this->info('Websockets service created successfully.');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    private function generateServiceCode()
    {
        $route = route('websockets.start');
        $serviceStub = file_get_contents(__DIR__ . '\..\..\WebsocketsService.stub');
        $serviceStub = str_replace('$delay', config('auto-installer.service_startup_delay'), $serviceStub);
        return str_replace('$url', $route, $serviceStub);
    }
}
