<?php

namespace Asiries335\redisSteamPhp\Consumer\Manager;

use Asiries335\redisSteamPhp\Consumer\ConsumerInterface;

interface ConsumerManagerInterface
{
    /**
     * @param ConsumerInterface[] $consumers
     * @return void
     */
    public function setConsumers(array $consumers): void;

    /**
     * @param mixed $payload
     * @return void
     */
    public function handle($payload): void;


    /**
     * @return ConsumerInterface[]
     */
    public function list(): array;
}