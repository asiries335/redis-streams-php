<?php

declare(strict_types=1);

/**
 * This class is work with redis' stream
 *
 * @author Sergei Karii <asiries335@gmail.com>
 */

namespace Asiries335\redisSteamPhp;

final class Client
{

    /**
     * Client.
     *
     * @var Redis
     */
    public $client;

    /**
     * Client constructor.
     *
     * @param \Redis $redisClient Redis
     */
    public function __construct(\Redis $redisClient)
    {
        $this->client = $redisClient;
    }

    /**
     * Work with stream
     *
     * @param string $nameStream Name stream
     *
     * @return mixed
     */
    public function stream(string $nameStream)
    {
        return new Stream($this->client, $nameStream);
    }
}