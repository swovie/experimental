<?php

use Dotenv\Dotenv;
use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;
use OpenSwoole\Http\Server;
use RTC\Watcher\Watcher;
use Viewi\App;

require 'vendor/autoload.php';

// Viewi application here
include __DIR__ . '/viewi-app/viewi.php';

Dotenv::createImmutable(__DIR__)->load();

$server = new Server($_ENV['SERVER_HOST'], $_ENV['SERVER_PORT']);

$server->on('request', function (Request $request, Response $response) {
    $htmlResponse = \Viewi\Routing\Router::handle(
        url: $request->server['request_uri'],
        method: $request->getMethod(),
        params: $request->get ?? []
    );

    $response->header('content-type', 'text/html');
    $response->end($htmlResponse);
});

// Create watcher instance
$watcher = Watcher::create();

$server->on('start', function (Server $server) use ($watcher) {
    echo "Server started at http://{$_ENV['SERVER_HOST']}:{$_ENV['SERVER_PORT']}\n";

    $watcher
        ->addPath(__DIR__ . '/viewi-app')
        ->onChange(function () use ($server) {
            // Compile Viewi Templates
            App::getEngine()->compile();
            // Reload Swoole Server
            $server->reload();
        })
        ->watch();
});

// Stop watcher
$server->on('shutdown', fn() => $watcher->stop());

// Start server
$server->start();