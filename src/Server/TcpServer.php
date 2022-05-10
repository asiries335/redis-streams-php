<?php

namespace Asiries335\redisSteamPhp\Server;

use Asiries335\redisSteamPhp\Listeners\ListenerInterface;
use React\Socket\ConnectionInterface;

/**
 *
 */
class TcpServer implements ServerInterface
{

    private array $config;

    /**
     * @var \React\Socket\ServerInterface
     */
    private $tcpServer = null;


    /**
     * @var ListenerInterface[]
     */
    private array $listeners;

    /**
     * @param array $config
     * @return void
     */
    public function setConfig(array $config): void {
        $this->config = $config;
    }

    /**
     * @return void
     */
    public function start(): void {
        if ($this->tcpServer !== null) {
            return;
        }

        $ip = $this->config['ip'] ?? '0.0.0.0';
        $port = $this->config['port'] ?? '2341';

        $this->tcpServer = new \React\Socket\TcpServer($ip . ':' . $port);

        $this->tcpServer->on('connection', function (ConnectionInterface $connection) {

            $connection->pipe($connection);

            $connection->on('data', function ($payload) {
                foreach ($this->listeners as $listener) {
                    $listener->handle($payload);
                }
            });
        });
    }

    /**
     * @return void
     */
    public function down(): void {
        $this->tcpServer->close();
    }

    /**
     * @param array $listeners
     * @return void
     */
    public function setListeners(array $listeners): void {
        $this->listeners = $listeners;
    }
}