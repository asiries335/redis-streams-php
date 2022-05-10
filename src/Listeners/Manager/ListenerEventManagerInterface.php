<?php

namespace Asiries335\redisSteamPhp\Listeners\Manager;

use Asiries335\redisSteamPhp\Listeners\ListenerContract;

interface ListenerEventManagerInterface
{
    /**
     * @param ListenerContract[] $listeners
     * @return void
     */
    public function setListeners(array $listeners): void;

    /**
     * @param mixed $payload
     * @return void
     */
    public function handle($payload): void;
}