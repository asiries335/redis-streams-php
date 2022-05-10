<?php

namespace Asiries335\redisSteamPhp\Consumer;

class DemoConsumer implements ConsumerInterface
{

    public function handle($payload) {
        echo 'привет я Demo Consumer - ' .  $payload;
    }
}