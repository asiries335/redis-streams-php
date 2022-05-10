<?php

namespace Asiries335\redisSteamPhp\Listeners\Manager;

use Asiries335\redisSteamPhp\Listeners\ListenerContract;

class TcpListenerEventManager implements ListenerEventManagerInterface
{
    /**
     * @var ListenerContract[]
     */
    private array $listeners;

    /**
     * @param ListenerContract[] $listeners
     * @return void
     */
    public function setListeners(array $listeners): void {
       $this->listeners = $listeners;
    }

    /**
     * @param mixed $payload
     * @return void
     */
    public function handle($payload): void {
        foreach ($this->listeners as $listener) {
            $listener->handle($payload);
        }
    }
}