<?php

namespace XiDanko\AutoInstaller;

use Illuminate\Support\ServiceProvider;
use XiDanko\AutoInstaller\Console\Commands\CreateDatabase;
use XiDanko\AutoInstaller\Console\Commands\CreateWebsocketsService;
use XiDanko\AutoInstaller\Console\Commands\GenerateAutoloader;
use XiDanko\AutoInstaller\Console\Commands\InstallApplication;
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
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->publishes([__DIR__ . '/../config/config.php' => config_path('auto-installer.php')], 'auto-installer-config');
        $this->publishes([__DIR__ . '/../bin' => base_path('tools')], 'auto-installer-tools');

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateDatabase::class,
                CreateWebsocketsService::class,
                GenerateAutoloader::class,
                InstallApplication::class,
                MoveToProduction::class,
                RestartHost::class,
                SetAsDefaultSite::class,
            ]);
        }
    }
}
