<?php


namespace Asiries335\redisSteamPhp\Hydrator;


use Predis\Response\ResponseInterface;

class MessageHydrator implements HydratorInterface
{

    public function hydrate(ResponseInterface $response, string $class)
    {
        var_dump($response);
        die();
    }
}