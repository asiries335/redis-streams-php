<?php

namespace Asiries335\redisSteamPhp\Server;

use Asiries335\redisSteamPhp\Listeners\ListenerContract;

interface ServerInterface
{
    /**
     * @param string $type (tcp, udp or etc)
     * @return void
     */
    public function setType(string $type): void;

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