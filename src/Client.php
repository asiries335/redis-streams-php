<?php


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
     * Appends the specified stream entry to the stream at the specified key
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