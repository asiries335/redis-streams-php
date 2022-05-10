<?php

namespace Asiries335\redisSteamPhp;

use Asiries335\redisSteamPhp\Listeners\Manager\ListenerEventManagerInterface;
use Asiries335\redisSteamPhp\Server\ServerInterface;

class ServerProvider
{

    private ServerInterface $server;
    private ListenerEventManagerInterface $listenerEventManager;

    /**
     * @param ServerInterface $server
     * @param ListenerEventManagerInterface $listenerEventManager
     *
     * @return void
     */
    public function __construct(ServerInterface $server, ListenerEventManagerInterface $listenerEventManager) {
        $this->server = $server;
        $this->listenerEventManager = $listenerEventManager;
    }

    public function boot(): void {
        $this->server->setListeners($this->listenerEventManager->list());
        $this->server->start();
    }


}