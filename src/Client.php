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
     * Client Redis Interface.
     *
     * @var ClientRedisStreamPhpInterface
     */
    private $_client;

    /**
     * Client constructor.
     *
     * @param ClientRedisStreamPhpInterface $redisClient Client redis interface
     */
    public function __construct(ClientRedisStreamPhpInterface $redisClient)
    {
        $this->_client = $redisClient;
    }

    /**
     * Work with stream
     *
     * @param string $streamName Name stream
     *
     * @return mixed
     */
    public function stream(string $streamName)
    {
        return new Stream($this->_client, $streamName);
    }

    /**
     * Work with stream group
     *
     * @param string $streamName Name stream
     *
     * @return mixed
     */
    public function streamGroup(string $streamName)
    {
        return new StreamGroup($this->_client, $streamName);
    }
}