<?php


namespace Asiries335\redisSteamPhp;

interface ClientRedisStreamPhpInterface
{
    /**
     * Call
     *
     * @param string $command
     * @param mixed ...$args
     *
     * @return mixed
     */
    public function call(string $command, ...$args);
}