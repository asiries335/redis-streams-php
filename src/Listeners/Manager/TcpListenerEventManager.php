<?php

namespace Asiries335\redisSteamPhp\Listeners\Manager;

use Asiries335\redisSteamPhp\Listeners\ListenerInterface;

class TcpListenerEventManager implements ListenerEventManagerInterface
{
    /**
     * @var ListenerInterface[]
     */
    private array $listeners;

    /**
     * @param ListenerInterface[] $listeners
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

    /**
     * @return ListenerInterface[]
     */
    public function list(): array {
        return $this->listeners;
    }
}