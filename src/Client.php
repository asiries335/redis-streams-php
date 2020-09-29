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
     * @return Stream
     */
    public function stream(string $streamName) : Stream
    {
        return new Stream($this->_client, $streamName);
    }

    /**
     * Work with stream group
     *
     * @param string $streamName Name stream
     *
     * @return StreamGroupConsumer
     */
    public function streamGroupConsumer(string $streamName) : StreamGroupConsumer
    {
        return new StreamGroupConsumer($this->_client, $streamName);
    }
}