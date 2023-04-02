<?php

namespace Backend;

use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;
use OpenSwoole\Http\Server as SWHttpServer;
use RTC\Watcher\Watcher;
use Viewi\App;
use Viewi\Routing\Router;

class Server
{
    protected readonly Watcher $watcher;
    protected readonly SWHttpServer $server;


    public function __construct(
        protected readonly string $host,
        protected readonly int    $port
    )
    {
    }

    public function watch(array $paths): static
    {
        $this->watcher = Watcher::create();
        $this->watcher->addPath($paths);
        return $this;
    }

    public function start(): void
    {
        $this->server = new SWHttpServer($this->host, $this->port);

        $this->server->on('request', function (Request $request, Response $response) {
            $htmlResponse = Router::handle(
                url: $request->server['request_uri'],
                method: $request->getMethod(),
                params: $request->get ?? []
            );

            $response->header('content-type', 'text/html');
            $response->end($htmlResponse);
        });


        $this->server->on('start', function (Server $server) {
            echo "Server started at http://{$this->host}:{$this->port}\n";

            if (isset($this->watcher)) {
                $this->watcher
                    ->addPath(__DIR__ . '/viewi-app')
                    ->onChange(function () use ($server) {
                        // Compile Viewi Templates
                        App::getEngine()->compile();
                        // Reload Swoole Server
                        $this->server->reload();
                    })
                    ->watch();
            }
        });

        // Stop watcher
        $this->server->on('shutdown', $this->handleShutdown(...));

    }


    private function handleShutdown(): void
    {
        if (isset($this->watcher)) {
            $this->watcher->stop();
        }
    }
}