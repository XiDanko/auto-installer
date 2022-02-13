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
            $serviceFileContent = $this->generateServiceCode();
            $target = $_SERVER['USERPROFILE'] . "/AppData/Roaming/Microsoft/Windows/Start Menu/Programs/Startup/$appName-websockets-service.vbs";
            $handler = fopen($target, 'w');
            fwrite($handler, $serviceFileContent);
            fclose($handler);
            $this->info('Websockets service created successfully.');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    private function generateServiceCode()
    {
        $route = route('websockets.start');
        return
            "
Set objShell = WScript.CreateObject(\"WScript.Shell\")
objShell.Run(\"curl ${route}\"), 0, True
            ";
    }
}
