<?php


namespace Asiries335\redisSteamPhp\Tests;

use Asiries335\redisSteamPhp\Client;
use Asiries335\redisSteamPhp\ClientRedisStreamPhpInterface;
use Asiries335\redisSteamPhp\Stream;
use Asiries335\redisSteamPhp\StreamGroupConsumer;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private $client;

    /**
     * setUp
     *
     * @return void
     */
    public function setUp() : void
    {
        $connector  = \Mockery::mock(ClientRedisStreamPhpInterface::class);
        $this->client = new Client($connector);
    }

    /**
     * test Stream
     *
     * @return void
     */
    public function testStream() : void
    {
        $result = $this->client->stream('stream-name');

        $this->assertInstanceOf(Stream::class, $result);
    }

    /**
     * test Group
     *
     * @return void
     */
    public function testGroup() : void
    {
        $result = $this->client->streamGroupConsumer('stream-name');

        $this->assertInstanceOf(StreamGroupConsumer::class, $result);
    }
}