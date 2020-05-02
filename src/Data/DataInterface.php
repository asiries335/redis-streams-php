<?php
/**
 * DataInterface
 */

namespace Asiries335\redisSteamPhp\Data;


interface DataInterface
{
    /**
     * Create data
     *
     * @param array $data Data
     *
     * @return static
     */
    public static function create(array $data);
}