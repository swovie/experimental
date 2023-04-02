<?php

namespace Swovie\Backend;

use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class Console
{
    protected static Console $instance;

    protected static OutputInterface $output;
    protected static string $prefix;


    public static function getInstance(bool $new = false): Console
    {
        if (!isset(self::$instance) || $new) {
            return self::$instance = new Console();
        }

        return self::$instance;
    }

    public static function setPrefix(string $prefix): void
    {
        self::$prefix = $prefix;
    }

    public static function getPrefix(): string
    {
        return self::$prefix ?? '';
    }

    protected static function getOutput(): OutputInterface
    {
        if (!isset(self::$output)) {
            self::$output = new ConsoleOutput();
        }

        return self::$output;
    }

    public static function comment(string $message): void
    {
        self::writeWithTimestamp("<comment>$message</comment>");
    }

    public static function info(string $message): void
    {
        self::writeWithTimestamp("<info>$message</info>");
    }

    public static function question(string $message): void
    {
        self::writeWithTimestamp("<question>$message</question>");
    }

    public static function error(string $message): void
    {
        self::writeWithTimestamp("<error>$message</error>");
    }

    public static function echo(string $message): void
    {
        self::writeWithTimestamp($message);
    }

    public static function write(string $message): void
    {
        self::writeWithTimestamp($message, false);
    }

    public static function writeln(string $message): void
    {
        self::writeWithTimestamp($message);
    }

    private static function writeWithTimestamp(string $message, bool $newLine = true): void
    {
        $message = self::prependTime(self::getPrefix() . $message);
        self::writeWithoutTimestamp($message, $newLine, false);
    }

    private static function writeWithoutTimestamp(string $message, bool $newLine = true, bool $prefix = true): void
    {
        $message = $prefix ? self::getPrefix() . $message : $message;
        self::getOutput()->write($message . ($newLine ? PHP_EOL : null));
    }

    protected static function prependTime(string $message): string
    {
        return date('[Y-m-d H:i:s]') . " $message";
    }
}