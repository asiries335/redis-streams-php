<?php


namespace Asiries335\redisSteamPhp;


use Asiries335\redisSteamPhp\Commands\Xadd;
use Predis\ClientInterface;

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
    private $nameStream;

    /**
     * Stream constructor.
     *
     * @param Redis  $client     Redis
     * @param string $nameStream Name stream
     */
    public function __construct(\Redis $client, string $nameStream)
    {
        $this->client     = $client;
        $this->nameStream = $nameStream;
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
                $this->nameStream,
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
    public function get() : array
    {
        try {
            return $this->client->rawCommand(
                'xread',
                'STREAMS',
                $this->nameStream,
                '0'
            );
        } catch (\Exception $exception) {
            throw $exception;
        }
    }


}