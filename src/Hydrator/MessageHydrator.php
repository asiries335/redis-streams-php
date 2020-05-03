<?php


namespace Asiries335\redisSteamPhp\Hydrator;


use Asiries335\redisSteamPhp\Data\DataInterface;
use Asiries335\redisSteamPhp\Data\Message;

class MessageHydrator implements HydratorInterface
{

    /**
     * Message hydrate
     *
     * @param array  $data  Data
     * @param string $class Class Message
     *
     * @return Message
     * @throws \ErrorException
     */
    public function hydrate(array $data, string $class) : Message
    {
        if (empty($data) === true) {
            throw new \ErrorException('Data is empty');
        }

        if (is_subclass_of($class, DataInterface::class) === false) {
            throw new \ErrorException('class is not implemented from DataInterface');
        }

        return call_user_func($class . '::create', $data);
    }
}