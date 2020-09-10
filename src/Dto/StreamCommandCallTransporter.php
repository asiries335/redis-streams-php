<?php


namespace Asiries335\redisSteamPhp\Dto;

use Dto\Dto;

class StreamCommandCallTransporter extends Dto
{
    /**
     * schema transfer object
     *
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            'command' => ['type' => 'string'],
            'args'    => ['type' => 'array']
        ],
        'required'   => [
            'command',
            'args',
        ],
    ];
}