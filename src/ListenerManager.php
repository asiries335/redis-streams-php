<?php

namespace Asiries335\redisSteamPhp;

use Asiries335\redisSteamPhp\Listeners\ListenerContract;

class ListenerManager
{
    /**
     * @var ListenerContract[]
     */
    private array $listeners;


    public function runAll($payload) {
        foreach ($this->listeners as $listener) {
            $listener->handle($payload);
        }
    }

    /**
     * @param ListenerContract[] $listeners
     */
    public function setListeners(array $listeners): void {
        $this->listeners = $listeners;
    }
}