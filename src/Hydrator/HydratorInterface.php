<?php

declare(strict_types=1);

namespace Asiries335\redisSteamPhp\Hydrator;

use Asiries335\redisSteamPhp\Data\DataInterface;
use Predis\Response\ResponseInterface;

interface HydratorInterface
{
    /**
     * Hydrate
     *
     * @param array  $data  Data
     * @param string $class Name data class
     *
     * @return mixed
     */
    public function hydrate(array $data, string $class);
}