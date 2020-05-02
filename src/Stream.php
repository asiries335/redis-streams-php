<?php


namespace Asiries335\redisSteamPhp;


use Asiries335\redisSteamPhp\Data\Collection;
use Asiries335\redisSteamPhp\Hydrator\CollectionHydrator;
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
     * @param Redis  $client     Redis
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
     * @return array
     *
     * @throws \Exception
     *
     * @see https://redis.io/commands/xread
     */
    public function get()
    {
        $collection = new CollectionHydrator();

        try {
            $items = $this->client->rawCommand(
                'xread',
                'STREAMS',
                $this->streamName,
                '0'
            );

             return $collection->hydrate($items, Collection::class);

        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function read()
    {
        $i = 0;
        //while (true) {

            $a = $this->client->rawCommand('XREVRANGE', $this->streamName, '+', '-', 'COUNT', 1);

            var_dump($a);

            //var_dump($i);
        //}
    }


}