<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;
use PHPUnit\Exception;

class SetAsDefaultSite extends Command
{
    protected $signature = 'app:set-as-default-site';

    protected $description = 'Set application as the default site';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $appName = env('APP_NAME');
            $this->info("Setting $appName as the default site...");
            $defaultSiteConfFile = realpath(base_path() . '../../../etc/apache2/sites-enabled/00-default.conf');
            file_put_contents($defaultSiteConfFile, $this->generateSiteConfig());
            $this->info("Setting $appName as the default site done successfully!");
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    public function generateSiteConfig()
    {
        $publicPath = public_path();
        return
            "
<VirtualHost *:80>
    DocumentRoot $publicPath
    ServerName localhost
    <Directory $publicPath>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
            ";
    }
}
