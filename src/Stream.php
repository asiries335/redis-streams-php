<?php


namespace Asiries335\redisSteamPhp;


use Asiries335\redisSteamPhp\Data\Collection;
use Asiries335\redisSteamPhp\Data\Message;
use Asiries335\redisSteamPhp\Hydrator\CollectionHydrator;
use Asiries335\redisSteamPhp\Hydrator\MessageHydrator;
use Redis;

final class Stream
{
    /**
     * Client
     *
     * @var Redis
     */
    private $client;

    /**
     * Name stream
     *
     * @var string
     */
    private $streamName;

    /**
     * Stream constructor.
     *
     * @param Redis  $client     Redis Client
     * @param string $nameStream Name stream
     */
    public function __construct(\Redis $client, string $nameStream)
    {
        $this->client     = $client;
        $this->streamName = $nameStream;
    }

    /**
     * Appends the specified stream entry to the stream at the specified key
     *
     * @param string $key
     * @param array  $values
     *
     * @return string
     *
     * @throws \Exception
     *
     * @see https://redis.io/commands/xadd
     */
    public function add(string $key, array $values) : string
    {
        try {
            return (string) $this->client->rawCommand(
                'xadd',
                $this->streamName,
                '*',
                $key,
                json_encode($values)
            );
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Get data from stream
     *
     * @return Collection
     *
     * @throws \Exception
     *
     * @see https://redis.io/commands/xread
     */
    public function get() : Collection
    {
        try {
            $items = $this->client->rawCommand(
                'xread',
                'STREAMS',
                $this->streamName,
                '0'
            );

            $collection = new CollectionHydrator();

            return $collection->hydrate($items, Collection::class);

        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Listen stream
     *
     * @param \Closure $closure User callback
     *
     * @return void
     *
     * @throws \ErrorException
     */
    public function listen(\Closure $closure) : void
    {
        $messageHydrate = new MessageHydrator();

        $lastMessageId = null;

        while (true) {

            $data = $this->client->rawCommand(
                'XREVRANGE',
                $this->streamName,
                '+',
                '-',
                'COUNT',
                1
            );

            if (empty($data) === true) {
                usleep(1);
                continue;
            }

            $message = $messageHydrate->hydrate($data[0], Message::class);

            if ($message->getId() !== $lastMessageId) {
                $lastMessageId = $message->getId();
                $closure->call($this, $message);
            }

            usleep(1);
        }

    }

}