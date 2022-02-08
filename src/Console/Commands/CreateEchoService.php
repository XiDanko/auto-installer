<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class CreateEchoService extends Command
{
    protected $signature = 'app:create-echo-service';

    protected $description = 'Create application echo server service';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $appName = env('app_name');
        try {
            $this->info('Creating echo service...');
            $serviceFile = $this->generateServiceFile();
            $target = $_SERVER['USERPROFILE'] . "/AppData/Roaming/Microsoft/Windows/Start Menu/Programs/Startup/$appName-echo-service.vbs";
            File::move($serviceFile, $target);
            $this->info('Echo service created successfully.');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    private function generateServiceCode()
    {
        $projectPath = base_path();
        return
            '
Set objShell = WScript.CreateObject("WScript.Shell")
objShell.Run("laravel-echo-server start --dir ' . $projectPath . '"), 0, True
            ';
    }

    private function generateServiceFile()
    {
        Storage::put('echo-service.vbs', $this->generateServiceCode());
        return Storage::path('echo-service.vbs');
    }
}
