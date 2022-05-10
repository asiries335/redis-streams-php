<?php

namespace Asiries335\redisSteamPhp;

use Asiries335\redisSteamPhp\Listeners\ListenerInterface;

class ListenerManager
{
    /**
     * @var ListenerInterface[]
     */
    private array $listeners;


    public function runAll($payload) {
        foreach ($this->listeners as $listener) {
            $listener->handle($payload);
        }
    }

    /**
     * @param ListenerInterface[] $listeners
     */
    public function setListeners(array $listeners): void {
        $this->listeners = $listeners;
    }
}