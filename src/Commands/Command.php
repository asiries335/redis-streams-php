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
     * Command constructor.
     *
     * @param ClientInterface $client ClientInterface
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

}