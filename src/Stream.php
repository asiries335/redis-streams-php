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
use Asiries335\redisSteamPhp\Dto\StreamCommandCallTransporter;
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
        $transporter = new StreamCommandCallTransporter(
            [
                'command' => Constants::COMMAND_XADD,
                'args'    => [
                    $this->_streamName,
                    '*',
                    $key,
                    json_encode($values)
                ]
            ]
        );

        try {
            return (string) $this->_client->call($transporter);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Find a message by id
     *
     * @param string $id Id Message
     *
     * @return Message
     *
     * @throws \Exception
     */
    public function findById(string $id) : Message
    {
        $transporter = new StreamCommandCallTransporter(
            [
                'command' => Constants::COMMAND_XREAD,
                'args'    => [
                    'STREAMS',
                    $this->_streamName,
                    $id
                ]
            ]
        );

        $item = $this->_client->call($transporter);

        if (empty($item) === true) {
            return new Message;
        }

        $message = new MessageHydrator();

        return $message->hydrate($item[0][1][0], Message::class);
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
        $transporter = new StreamCommandCallTransporter(
            [
                'command' => Constants::COMMAND_XDEL,
                'args'    => [
                    $this->_streamName,
                    $key
                ]
            ]
        );

        try {
            return (int) $this->_client->call($transporter);
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
        $transporter = new StreamCommandCallTransporter(
            [
                'command' => Constants::COMMAND_XREAD,
                'args'    => [
                    'STREAMS',
                    $this->_streamName,
                    '0'
                ]
            ]
        );

        try {
            $items = $this->_client->call($transporter);

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
     */
    public function listen(\Closure $closure) : void
    {
        $messageHydrate = new MessageHydrator();

        $loop = \React\EventLoop\Factory::create();

        $loop->addPeriodicTimer(
            Constants::TIME_TICK_INTERVAL,
            function () use ($closure, $messageHydrate, $loop) {
                $transporter = new StreamCommandCallTransporter(
                    [
                        'command' => Constants::COMMAND_XRANGE,
                        'args'    => [
                            $this->_streamName,
                            '-',
                            '+'
                        ]
                    ]
                );

                $rows = $this->_client->call($transporter);

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