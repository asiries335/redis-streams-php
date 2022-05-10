<?php

namespace Asiries335\redisSteamPhp;

use Asiries335\redisSteamPhp\Consumer\Manager\ConsumerManagerInterface;
use Asiries335\redisSteamPhp\Server\ServerInterface;

class ServerProvider
{
    private ServerInterface $server;
    private ConsumerManagerInterface $consumerManager;

    /**
     * @param ServerInterface $server
     * @param ConsumerManagerInterface $consumerManager
     *
     * @return void
     */
    public function __construct(ServerInterface $server, ConsumerManagerInterface $consumerManager) {
        $this->server = $server;
        $this->consumerManager = $consumerManager;
    }

    public function boot(): void {
        $this->server->setConsumers($this->consumerManager->list());
        $this->server->start();
    }


}