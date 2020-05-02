<?php
/**
 * Object data collection
 */

namespace Asiries335\redisSteamPhp\Data;


final class Collection implements DataInterface
{
    /**
     * Name collection
     *
     * @var string
     */
    private $_name;

    /**
     * Messages collection
     *
     * @var array
     */
    private $_messages;

    /**
     * Collection create
     *
     * @param array $data Data collection
     *
     * @return static
     */
    public static function create(array $data) : self
    {
        $collection = new self();

        $collection->_name = $data[0][0] ?? null;

        foreach ($data[0][1] as $item) {
            $collection->_messages[] = Message::create($item);
        }

        return $collection;
    }

    /**
     * Get name collection
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->_name;
    }

    /**
     * Get messages collection
     *
     * @return array
     */
    public function getMessages() : array
    {
        return $this->_messages;
    }
}