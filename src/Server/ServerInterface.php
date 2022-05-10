<?php

namespace Asiries335\redisSteamPhp\Server;

use Asiries335\redisSteamPhp\Consumer\ConsumerInterface;

interface ServerInterface
{

    /**
     * @param ConsumerInterface[] $listeners
     * @return void
     */
    public function setListeners(array $listeners): void;

    /**
     * @param array $config
     * @return void
     */
    public function setConfig(array $config): void;

    /**
     * @return void
     */
    public function start(): void;

    /**
     * @return void
     */
    public function down(): void;
}