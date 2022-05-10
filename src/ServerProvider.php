<?php

namespace Asiries335\redisSteamPhp;

use Asiries335\redisSteamPhp\Consumer\Manager\ConsumerManagerInterface;
use Asiries335\redisSteamPhp\Server\ServerInterface;

class ServerProvider
{

    private ServerInterface $server;
    private ConsumerManagerInterface $listenerEventManager;

    /**
     * @param ServerInterface $server
     * @param ConsumerManagerInterface $listenerEventManager
     *
     * @return void
     */
    public function __construct(ServerInterface $server, ConsumerManagerInterface $listenerEventManager) {
        $this->server = $server;
        $this->listenerEventManager = $listenerEventManager;
    }

    public function boot(): void {
        $this->server->setListeners($this->listenerEventManager->list());
        $this->server->start();
    }


}