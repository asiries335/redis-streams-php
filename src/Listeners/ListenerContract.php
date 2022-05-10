<?php

namespace Asiries335\redisSteamPhp\Listeners;

interface ListenerContract
{
    public function handle($payload);
}