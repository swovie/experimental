<?php

use Dotenv\Dotenv;
use OpenSwoole\Runtime;
use Swovie\Backend\Server;
use Viewi\App;
use Viewi\AppInit;

require 'vendor/autoload.php';

// Load Viewi routes
include __DIR__ . '/viewi/routes.php';

const BASE_DIR = __DIR__ . '/';

Dotenv::createImmutable(__DIR__)->load();

Runtime::enableCoroutine();
Runtime::setHookFlags(Runtime::HOOK_ALL);

App::initEngine(
    init: AppInit::create()
        ->setMode('local' == $_ENV['APP_ENV'])
        ->setOutputMode()
        ->setServerBuildDir(__DIR__ . '/viewi/build')
        ->setSourceDir(__DIR__ . '/viewi/Components')
        ->setPublicBuildDir('')
        ->setPublicRootDir(__DIR__ . '/public')
);

Server::create($_ENV['SERVER_HOST'], $_ENV['SERVER_PORT'])
    ->watch([__DIR__ . '/viewi/', __DIR__ . '/public'])
    ->withStaticFileHandler(true)
    ->withDocumentRoot(__DIR__ . '/public')
    ->start();
