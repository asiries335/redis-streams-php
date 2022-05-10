<?php

namespace Asiries335\redisSteamPhp;

use Asiries335\redisSteamPhp\Listeners\Manager\ListenerEventManagerInterface;
use Asiries335\redisSteamPhp\Server\ServerInterface;

class ServerProvider
{
    /**
     * @var ServerInterface
     */
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

    public function boot(): void
    {
        $this->server->start();

    }


}