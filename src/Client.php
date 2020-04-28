<?php


namespace Asiries335\redisSteamPhp;

use Predis\ClientInterface;
use Predis\Command\CommandInterface;

final class Client
{

    /**
     * Client.
     *
     * @var ClientInterface
     */
    public $client;

    /**
     * Client constructor.
     *
     * @param ClientInterface $client ClientInterface
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Appends the specified stream entry to the stream at the specified key
     *
     * @param array $args Args Command
     *
     * @return CommandInterface
     */
    public function xadd(array $args = [])
    {
        return $this->client->createCommand('xadd', $args);
    }
}