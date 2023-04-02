<?php

use RTC\Watcher\Watcher;
use RTC\Watcher\Watching\EventInfo;

require 'vendor/autoload.php';

Watcher::create()
    ->addPath(__DIR__ . '/viewi-app')
    ->onChange(function (EventInfo $eventInfo) {
        echo $eventInfo->getWatchedItem()->getFullPath() . PHP_EOL;
    })
    ->watch();
