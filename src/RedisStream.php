<?php

declare(strict_types=1);

namespace Asiries335\redisSteamPhp;

abstract class RedisStream
{
    /**
     * Client
     *
     * @var ClientRedisStreamPhpInterface
     */
    protected $_client;

    /**
     * Name stream
     *
     * @var string
     */
    protected $_streamName;

    /**
     * Stream constructor.
     *
     * @param ClientRedisStreamPhpInterface $client     ClientRedisInterface
     * @param string                        $nameStream Name stream
     */
    public function __construct(ClientRedisStreamPhpInterface $client, string $nameStream)
    {
        $this->_client     = $client;
        $this->_streamName = $nameStream;
    }
}