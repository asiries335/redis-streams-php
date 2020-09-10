<?php


namespace Asiries335\redisSteamPhp;

use Asiries335\redisSteamPhp\Dto\StreamCommandCallTransporter;

interface ClientRedisStreamPhpInterface
{
    /**
     * Call
     *
     * @param StreamCommandCallTransporter $streamCommandCallTransporter
     *
     * @return mixed
     */
    public function call(StreamCommandCallTransporter $streamCommandCallTransporter);
}