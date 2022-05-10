<?php

namespace Asiries335\redisSteamPhp\Server;

use Asiries335\redisSteamPhp\Consumer\ConsumerInterface;

interface ServerInterface
{

    /**
     * @param ConsumerInterface[] $consumers
     * @return void
     */
    public function setConsumers(array $consumers): void;

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