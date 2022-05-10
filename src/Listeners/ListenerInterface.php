<?php

namespace Asiries335\redisSteamPhp\Listeners;

interface ListenerInterface
{
    public function handle($payload);
}