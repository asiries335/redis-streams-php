<?php

namespace Asiries335\redisSteamPhp\Listeners\Manager;

use Asiries335\redisSteamPhp\Listeners\ListenerInterface;

interface ListenerEventManagerInterface
{
    /**
     * @param ListenerInterface[] $listeners
     * @return void
     */
    public function setListeners(array $listeners): void;

    /**
     * @param mixed $payload
     * @return void
     */
    public function handle($payload): void;


    /**
     * @return ListenerInterface[]
     */
    public function list(): array;
}