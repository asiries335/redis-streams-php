<?php


namespace Asiries335\redisSteamPhp\Commands;


use Predis\ClientInterface;

abstract class Command
{
    /**
     * Client.
     *
     * @var ClientInterface
     */
    public $client;

    /**
     * Args command.
     *
     * @var array
     */
    public $args = [];

    /**
     * Command constructor.
     *
     * @param ClientInterface $client ClientInterface
     * @param array           $args   array
     */
    public function __construct(ClientInterface $client, array $args = [])
    {
        $this->client = $client;
    }

    /**
     * Get args command
     *
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * Set args command
     *
     * @param array $args
     */
    public function setArgs(array $args)
    {
        $this->args = $args;
    }
}