<?php

namespace Asiries335\redisSteamPhp\Listeners;

class DemoListener implements ListenerContract
{

    public function handle($payload) {
        echo 'привет я DemoListener - ' .  $payload;
    }
}