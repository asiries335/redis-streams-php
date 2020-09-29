<?php


namespace Asiries335\redisSteamPhp\Data;


final class Constants
{
    /**
     * COMMAND XADD
     *
     * @var string
     */
    public const COMMAND_XADD = 'xadd';

    /**
     * COMMAND XREAD
     *
     * @var string
     */
    public const COMMAND_XREAD = 'xread';

    /**
     * COMMAND XGROUP
     *
     * @var string
     */
    public const COMMAND_XGROUP = 'xgroup';

    /**
     * COMMAND XRANGE
     *
     * @var string
     */
    public const COMMAND_XRANGE = 'xrange';

    /**
     * COMMAND OPTION CREATE
     *
     * @var string
     */
    public const COMMAND_OPTION_XGROUP_CREATE = 'CREATE';

    /**
     * COMMAND OPTION DESTROY
     *
     * @var string
     */
    public const COMMAND_OPTION_XGROUP_DESTROY = 'DESTROY';

    /**
     * TIME TICK INTERVAL
     *
     * @var float
     */
    public const TIME_TICK_INTERVAL = 1;

    /**
     * COMMAND XDEL
     *
     * @var string
     */
    public const COMMAND_XDEL = 'xdel';
}