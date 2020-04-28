<?php


namespace Asiries335\redisSteamPhp\Commands;


use Predis\ClientInterface;

class Xadd extends Command
{
    /**
     *
     *
     * @return string
     */
    public function add() : string
    {
        var_dump($this->getArgs());
    }
}