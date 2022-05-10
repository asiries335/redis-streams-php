<?php

namespace Asiries335\redisSteamPhp\Consumer\Manager;

use Asiries335\redisSteamPhp\Consumer\ConsumerInterface;

class TcpConsumerManager implements ConsumerManagerInterface
{
    /**
     * @var ConsumerInterface[]
     */
    private array $consumers;

    /**
     * @param ConsumerInterface[] $consumers
     * @return void
     */
    public function setConsumers(array $consumers): void {
       $this->consumers = $consumers;
    }

    /**
     * @param mixed $payload
     * @return void
     */
    public function handle($payload): void {
        foreach ($this->consumers as $consumer) {
            $consumer->handle($payload);
        }
    }

    /**
     * @return ConsumerInterface[]
     */
    public function list(): array {
        return $this->consumers;
    }
}