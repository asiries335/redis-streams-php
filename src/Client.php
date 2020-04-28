<?php


namespace Asiries335\redisSteamPhp;

use Asiries335\redisSteamPhp\Commands\Xadd;
use Predis\ClientInterface;
use Predis\Command\CommandInterface;

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
     * Appends the specified stream entry to the stream at the specified key
     *
     * @param string|null $nameStream
     *
     */
    public function stream(string $nameStream = null)
    {
        return new Stream($this->client, $nameStream);
    }
}