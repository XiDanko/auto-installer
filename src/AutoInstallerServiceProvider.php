<?php

namespace XiDanko\AutoInstaller;

use Illuminate\Support\ServiceProvider;
use XiDanko\AutoInstaller\Console\Commands\CreateDatabase;
use XiDanko\AutoInstaller\Console\Commands\CreateEchoService;
use XiDanko\AutoInstaller\Console\Commands\GenerateAutoloader;
use XiDanko\AutoInstaller\Console\Commands\InstallApplication;
use XiDanko\AutoInstaller\Console\Commands\InstallLaravelEchoServer;
use XiDanko\AutoInstaller\Console\Commands\MoveToProduction;
use XiDanko\AutoInstaller\Console\Commands\RestartHost;
use XiDanko\AutoInstaller\Console\Commands\SetAsDefaultSite;

class AutoInstallerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'auto-installer');
    }

    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/config.php' => config_path('auto-installer.php')], 'auto-installer-config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateDatabase::class,
                CreateEchoService::class,
                GenerateAutoloader::class,
                InstallApplication::class,
                InstallLaravelEchoServer::class,
                MoveToProduction::class,
                RestartHost::class,
                SetAsDefaultSite::class,
            ]);
        }
    }
}
