<?php


namespace Asiries335\redisSteamPhp\Tests;


use Asiries335\redisSteamPhp\ClientRedisStreamPhpInterface;
use Asiries335\redisSteamPhp\StreamGroupConsumer;
use PHPUnit\Framework\TestCase;

class StreamGroupConsumerTest extends TestCase
{
    private $client;

    private const TEST_NAME_STREAM = 'test_stream';

    private const TEST_NAME_GROUP = 'test_group';

    /**
     * setUp
     *
     * @return void
     */
    public function setUp() : void
    {
        $this->client = \Mockery::mock(ClientRedisStreamPhpInterface::class);
    }

    /**
     * Create a group
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testCreateGroup() : void
    {
        $this->client->shouldReceive('call')->andReturn(true);

        $streamGroup = new StreamGroupConsumer($this->client, self::TEST_NAME_STREAM);

        $result = $streamGroup->create(self::TEST_NAME_GROUP, true);

        $this->assertEquals(true, $result);
    }

    /**
     * Destroy a group
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testDestroyGroup() : void
    {
        $this->client->shouldReceive('call')->andReturn(true);

        $streamGroup = new StreamGroupConsumer($this->client, self::TEST_NAME_STREAM);

        $result = $streamGroup->destroy(self::TEST_NAME_GROUP);

        $this->assertEquals(true, $result);
    }

    /**
     * Test delete a consumer from group
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testDeleteConsumerGroup() : void
    {
        $this->client->shouldReceive('call')->andReturn(true);

        $streamGroup = new StreamGroupConsumer($this->client, self::TEST_NAME_STREAM);

        $result = $streamGroup->deleteConsumer(self::TEST_NAME_GROUP, 'consumerName');

        $this->assertEquals(true, $result);
    }
}