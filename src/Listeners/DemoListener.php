<?php

namespace Asiries335\redisSteamPhp\Listeners;

class DemoListener implements ListenerInterface
{

    public function handle($payload) {
        echo 'привет я DemoListener - ' .  $payload;
    }
}