<?php

declare(strict_types=1);

/**
 * Stream class
 *
 * @author Sergei Karii <asiries335@gmail.com>
 */

namespace Asiries335\redisSteamPhp;

use Asiries335\redisSteamPhp\Data\Collection;
use Asiries335\redisSteamPhp\Data\Constants;
use Asiries335\redisSteamPhp\Data\Message;
use Asiries335\redisSteamPhp\Hydrator\CollectionHydrator;
use Asiries335\redisSteamPhp\Hydrator\MessageHydrator;


final class Stream
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

    /**
     * Appends the specified stream entry to the stream at the specified key
     *
     * @param string $key    Key Message
     * @param array  $values Value Message
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
            return (string) $this->_client->call(
                Constants::COMMAND_XADD,
                $this->_streamName,
                '*',
                $key,
                json_encode($values)
            );
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Removes the messages entries from a stream
     *
     * @param string $key Key Message
     *
     * @return int
     *
     * @throws \Exception
     *
     * @see https://redis.io/commands/xdel
     */
    public function delete(string $key) : int
    {
        try {
            return (int) $this->_client->call(
                Constants::COMMAND_XDEL,
                $this->_streamName,
                $key
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
            $items = $this->_client->call(
                Constants::COMMAND_XREAD,
                'STREAMS',
                $this->_streamName,
                '0'
            );

            $collection = new CollectionHydrator();

            if (empty($items) === true) {
                return new Collection;
            }

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

        $loop = \React\EventLoop\Factory::create();

        $loop->addPeriodicTimer(
            Constants::TIME_TICK_INTERVAL,
            function () use ($closure, $messageHydrate, $loop) {
                $rows = $this->_client->call(
                    Constants::COMMAND_XRANGE,
                    $this->_streamName,
                    '-',
                    '+'
                );

                if (empty($rows) === true) {
                    return;
                }

                foreach ($rows as $row) {
                    $message = $messageHydrate->hydrate($row, Message::class);
                    $closure->call($this, $message);
                    $this->delete($message->getId());
                }
            }
        );

        $loop->run();
    }

}