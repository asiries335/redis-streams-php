<?php
/**
 * Object data message
 */

namespace Asiries335\redisSteamPhp\Data;


final class Message implements DataInterface
{
    /**
     * Id message
     *
     * @var string
     */
    private $_id;

    /**
     * Key message
     *
     * @var string
     */
    private $_key;

    /**
     * Body message
     *
     * @var mixed
     */
    private $_body;

    /**
     * Message create
     *
     * @param array $data Data Message
     *
     * @return static
     */
    public static function create(array $data) : self
    {
        $message = new self();

        $message->_id   = $data[0] ?? null;
        $message->_key  = $data[1][0] ?? null;
        $message->_body = $data[1][1] ?? null;

        return $message;
    }

    /**
     * Get id message
     *
     * @return string
     */
    public function getId() : string
    {
        return $this->_id;
    }

    /**
     * Get key message
     *
     * @return string
     */
    public function getKey() : string
    {
        return $this->_key;
    }

    /**
     * Get body message
     *
     * @return mixed
     */
    public function getBody()
    {
        return $this->_body;
    }
}