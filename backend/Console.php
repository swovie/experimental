<?php

namespace Backend;

use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class Console
{
    protected static Console $instance;

    protected OutputInterface $output;
    protected string $prefix;


    public static function getInstance(bool $new = false): Console
    {
        if (!isset(self::$instance) || $new) {
            return self::$instance = new Console();
        }

        return self::$instance;
    }

    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function getPrefix(): string
    {
        return $this->prefix ?? '';
    }

    protected function getOutput(): OutputInterface
    {
        if (!isset($this->output)) {
            $this->output = new ConsoleOutput();
        }

        return $this->output;
    }

    public function comment(string $message): void
    {
        $this->writeWithTimestamp("<comment>$message</comment>");
    }

    public function info(string $message): void
    {
        $this->writeWithTimestamp("<info>$message</info>");
    }

    public function question(string $message): void
    {
        $this->writeWithTimestamp("<question>$message</question>");
    }

    public function error(string $message): void
    {
        $this->writeWithTimestamp("<error>$message</error>");
    }

    public function echo(string $message): void
    {
        $this->writeWithTimestamp($message);
    }

    public function write(string $message): void
    {
        $this->writeWithTimestamp($message, false);
    }

    public function writeln(string $message): void
    {
        $this->writeWithTimestamp($message);
    }

    private function writeWithTimestamp(string $message, bool $newLine = true): void
    {
        $message = $this->prependTime(self::getPrefix() . $message);
        self::writeWithoutTimestamp($message, $newLine, false);
    }

    private function writeWithoutTimestamp(string $message, bool $newLine = true, bool $prefix = true): void
    {
        $message = $prefix ? self::getPrefix() . $message : $message;
        $this->getOutput()->write($message . ($newLine ? PHP_EOL : null));
    }

    protected function prependTime(string $message): string
    {
        return date('[Y-m-d H:i:s]') . " $message";
    }
}