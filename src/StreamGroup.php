<?php


namespace Asiries335\redisSteamPhp;


final class StreamGroup
{
    /**
     * Client
     *
     * @var ClientRedisStreamPhpInterface
     */
    private $_client;

    /**
     * Name stream
     *
     * @var string
     */
    private $_streamName;

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