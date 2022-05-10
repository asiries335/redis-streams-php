<?php

namespace Asiries335\redisSteamPhp\Consumer;

interface ConsumerInterface
{
    public function handle($payload);
}