<?php


namespace Asiries335\redisSteamPhp\Hydrator;


use Asiries335\redisSteamPhp\Data\DataInterface;
use Asiries335\redisSteamPhp\Data\Message;
use Predis\Response\ResponseInterface;

class MessageHydrator implements HydratorInterface
{

    /**
     * @param array $data
     * @param string $class
     * @return mixed|void
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