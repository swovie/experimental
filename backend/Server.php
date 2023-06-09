<?php

namespace Swovie\Backend;

use Exception;
use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;
use OpenSwoole\Timer;
use OpenSwoole\WebSocket\Frame;
use OpenSwoole\Websocket\Server as SWHttpServer;
use ReflectionException;
use RTC\Watcher\Watcher;
use RTC\Watcher\Watching\EventInfo;
use Viewi\App;
use Viewi\Routing\Router;

class Server
{
    protected readonly Watcher $watcher;
    protected readonly SWHttpServer $server;
    protected string $documentRoot;
    protected bool $withStaticHandler;
    protected int $reloadTimerId;
    protected int $reloadTimerTimeoutAt;
    protected int $reloadTimerInterval = 150;


    public function __construct(
        protected readonly string $host,
        protected readonly int    $port
    )
    {
    }


    public static function create(string $host, int $port): static
    {
        return new static($host, $port);
    }

    /**
     * @param bool $isRecompiling
     * @return void
     * @throws ReflectionException
     */
    public static function compileViewi(bool $isRecompiling = false): void
    {
        $compileWord = $isRecompiling ? 'recompiling' : 'compiling';
        Console::comment(sprintf('%s viewi...', $compileWord));
        App::getEngine()->compile();
    }

    public function watch(array $paths): static
    {
        $this->watcher = Watcher::create();
        $this->watcher->addPath($paths);
        return $this;
    }

    public function withDocumentRoot(string $path): static
    {
        $this->documentRoot = $path;
        return $this;
    }

    public function withStaticFileHandler(bool $state): static
    {
        $this->withStaticHandler = $state;
        return $this;
    }

    /**
     * @return void
     */
    public function start(): void
    {
        $this->server = new SWHttpServer($this->host, $this->port);

        // Handle Request Event
        $this->server->on('request', $this->handleRequest(...));

        // Handle Message Event
        $this->server->on('message', $this->handleMessage(...));

        // Handle Start Event
        $this->server->on('start', $this->handleStart(...));

        // Handle Shutdown Event
        $this->server->on('shutdown', $this->handleShutdown(...));

        // Set configurations
        $this->server->set($this->generateServerConfigs());

        // Start Server
        $this->server->start();
    }

    protected function generateServerConfigs(): array
    {
        $config = [];

        if (isset($this->withStaticHandler)) {
            $config['enable_static_handler'] = $this->withStaticHandler;
        }

        if (isset($this->documentRoot)) {
            $config['document_root'] = $this->documentRoot;
        }

        return $config;
    }

    private function handleMessage(\OpenSwoole\WebSocket\Server $server, Frame $frame): void
    {

    }

    /**
     * @param Request $request
     * @param Response $response
     * @return void
     * @throws Exception
     */
    private function handleRequest(Request $request, Response $response): void
    {
        $htmlResponse = Router::handle(
            url: $request->server['request_uri'],
            method: $request->getMethod(),
            params: $request->get ?? []
        );

        $response->header('content-type', 'text/html');
        $response->end($htmlResponse);
    }

    /**
     * @param SWHttpServer $server
     * @return void
     * @throws ReflectionException
     */
    private function handleStart(SWHttpServer $server): void
    {
        Console::info("server started at http://$this->host:$this->port");

        // Compile Viewi Templates
        self::compileViewi(isRecompiling: true);

        if (isset($this->watcher)) {
            Console::comment('watcher started');

            $this->watcher->onChange(function (EventInfo $info) use ($server) {
                Console::cyan(sprintf('file updated: %s', $info->getWatchedItem()->getFullPath()));

                if (isset($this->reloadTimerTimeoutAt) && $this->reloadTimerTimeoutAt > microtime(true)) {
                    Timer::clear($this->reloadTimerId);
                }

                $this->reloadTimerTimeoutAt = microtime(true) + $this->reloadTimerInterval;
                $this->reloadTimerId = Timer::after($this->reloadTimerInterval, function () {
                    // Compile Viewi Templates
                    self::compileViewi(isRecompiling: true);

                    Console::comment('restarting server...');
                    // Reload Swoole Server
                    $this->server->reload();
                });
            });

            $this->watcher->watch();
        }
    }

    private function handleShutdown(): void
    {
        if (isset($this->watcher)) {
            $this->watcher->stop();
            Console::comment('watcher stopped');
        }

        Console::comment('server shutdown');
    }
}