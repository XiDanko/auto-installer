<?php

namespace XiDanko\AutoInstaller;

use Illuminate\Support\ServiceProvider;
use XiDanko\AutoInstaller\Console\Commands\CreateDatabase;
use XiDanko\AutoInstaller\Console\Commands\CreateOctaneService;
use XiDanko\AutoInstaller\Console\Commands\CreateQueueService;
use XiDanko\AutoInstaller\Console\Commands\CreateSchedulerService;
use XiDanko\AutoInstaller\Console\Commands\InstallApplication;
use XiDanko\AutoInstaller\Console\Commands\RestartHost;
use XiDanko\AutoInstaller\Console\Commands\SetAsDefaultSite;
use XiDanko\AutoInstaller\Console\Commands\StartOctane;

class AutoInstallerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'auto-installer');
    }

    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/config.php' => config_path('auto-installer.php')], 'auto-installer-config');
        $this->publishes([__DIR__ . '/../bin' => base_path('tools')], 'auto-installer-tools');

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateDatabase::class,
                CreateSchedulerService::class,
                CreateQueueService::class,
                CreateOctaneService::class,
                InstallApplication::class,
                RestartHost::class,
                SetAsDefaultSite::class,
                StartOctane::class,
            ]);
        }
    }
}
