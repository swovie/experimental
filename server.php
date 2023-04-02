<?php

use Swovie\Backend\Server;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

// Viewi application here
include __DIR__ . '/viewi-app/viewi.php';

Dotenv::createImmutable(__DIR__)->load();

Server::create($_ENV['SERVER_HOST'], $_ENV['SERVER_PORT'])
    ->watch([__DIR__ . '/viewi-app/'])
    ->start();
