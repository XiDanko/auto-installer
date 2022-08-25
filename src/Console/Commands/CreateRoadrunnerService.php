<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class CreateRoadrunnerService extends Command
{
    protected $signature = 'app:create-roadrunner-service';

    protected $description = 'Create roadrunner service';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $appName = env('app_name');
        try {
            $this->info('Creating roadrunner service...');
            $service = $this->generateServiceCode();
            $target = $_SERVER['USERPROFILE'] . "/AppData/Roaming/Microsoft/Windows/Start Menu/Programs/Startup/$appName-roadrunner-service.vbs";
            $handler = fopen($target, 'w');
            fwrite($handler, $service);
            fclose($handler);
            $this->info('Roadrunner service created successfully.');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    private function generateServiceCode()
    {
        $serviceStub = file_get_contents(__DIR__ . '\..\..\RoadrunnerService.stub');
        $serviceStub = str_replace('$delay', config('auto-installer.roadrunner.service_startup_delay'), $serviceStub);
        $serviceStub = str_replace('$rrPath', config('auto-installer.roadrunner.executable_path'), $serviceStub);
        $serviceStub = str_replace('$rrConfigPath', config('auto-installer.roadrunner.config_path'), $serviceStub);
        return $serviceStub;
    }
}
