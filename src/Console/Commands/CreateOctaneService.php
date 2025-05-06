<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class CreateOctaneService extends Command
{
    protected $signature = 'app:create-octane-service';

    protected $description = 'Create octane service';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $appName = config('app.name');
        try {
            $this->info('Creating octane service...');
            $service = $this->generateServiceCode();
            $target = $_SERVER['USERPROFILE'] . "/AppData/Roaming/Microsoft/Windows/Start Menu/Programs/Startup/$appName-octane-service.vbs";
            $handler = fopen($target, 'w');
            fwrite($handler, $service);
            fclose($handler);
            $this->info('Octane service created successfully.');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    private function generateServiceCode()
    {
        $serviceStub = file_get_contents(__DIR__ . '\..\..\Stubs\OctaneService.stub');
        $serviceStub = str_replace('$delay', config('auto-installer.services_startup_delay'), $serviceStub);
        $serviceStub = str_replace('$phpPath', PHP_BINARY, $serviceStub);
        $serviceStub = str_replace('$artisanPath', base_path('artisan'), $serviceStub);
        return $serviceStub;
    }
}
