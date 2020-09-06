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
     * @param string $nameStream Name stream
     *
     * @return mixed
     */
    public function stream(string $nameStream)
    {
        return new Stream($this->_client, $nameStream);
    }
}