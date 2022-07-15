<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;

class CreateDatabase extends Command
{
    protected $signature = 'app:create-database';

    protected $description = 'Create application database';
    private $host;
    private $port;
    private $username;
    private $password;
    private $database;

    public function __construct()
    {
        parent::__construct();
        $this->host = env('DB_HOST');
        $this->port = env('DB_PORT');
        $this->username = env('DB_USERNAME');
        $this->password = env('DB_PASSWORD');
        $this->database = env('DB_DATABASE');
    }

    public function handle()
    {
        try {
            $this->info('Creating database...');
            if (env('DB_CONNECTION') === 'mysql') $this->createMysqlDatabase();
            else if (env('DB_CONNECTION') === 'sqlsrv') $this->createSqlServerDatabase();
            $this->info('Database created successfully.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    private function createMysqlDatabase()
    {
        $mysql = new \mysqli("$this->host:$this->port", $this->username, $this->password);
        $mysql->query("CREATE DATABASE $this->database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    private function createSqlServerDatabase()
    {
        exec("sqlcmd -S tcp:$this->host,$this->port -U \"$this->username\" -P \"$this->password\" -Q \"CREATE DATABASE $this->database\"");
    }
}
