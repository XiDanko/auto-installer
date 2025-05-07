<?php

namespace XiDanko\AutoInstaller\Console\Commands;

use Illuminate\Console\Command;

class StartOctane extends Command
{
    public $signature = 'app:start-octane
                    {--server= : The server that should be used to serve the application}
                    {--host= : The IP address the server should bind to}
                    {--port= : The port the server should be available on [default: "8000"]}
                    {--rpc-host= : The RPC IP address the server should bind to}
                    {--rpc-port= : The RPC port the server should be available on}
                    {--workers=auto : The number of workers that should be available to handle requests}
                    {--max-requests=500 : The number of requests to process before reloading the server}
                    {--rr-config= : The path to the RoadRunner .rr.yaml file}
                    {--watch : Automatically reload the server when the application is modified}
                    {--poll : Use file system polling while watching in order to watch files over a network}
                    {--log-level= : Log messages at or above the specified log level}';

    public $description = 'Start the Octane server';

    public function handle(): void
    {
        $path = storage_path('logs/octane-server-state.json');
        if (file_exists($path)) {
            unlink($path);
        }

        $this->call('octane:roadrunner', [
            '--host' => $this->getHost(),
            '--port' => $this->getPort(),
            '--rpc-host' => $this->option('rpc-host'),
            '--rpc-port' => $this->option('rpc-port'),
            '--workers' => $this->option('workers'),
            '--max-requests' => $this->option('max-requests'),
            '--rr-config' => $this->option('rr-config'),
            '--watch' => $this->option('watch'),
            '--poll' => $this->option('poll'),
            '--log-level' => $this->option('log-level'),
        ]);
    }

    protected function getHost(): string
    {
        return $this->option('host') ?? config('octane.host') ?? $_ENV['OCTANE_HOST'] ?? '0.0.0.0';
    }

    protected function getPort(): string
    {
        return $this->option('port') ?? config('octane.port') ?? $_ENV['OCTANE_PORT'] ?? '9090';
    }
}
