<?php


namespace Asiries335\redisSteamPhp;


use Asiries335\redisSteamPhp\Data\Constants;
use Asiries335\redisSteamPhp\Dto\StreamCommandCallTransporter;

final class StreamGroupConsumer extends RedisStream
{
    /**
     * Create group Consumer
     *
     * @param string $groupName
     * @param bool $isShowFullHistoryStream
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function create(string $groupName, bool $isShowFullHistoryStream = true) : bool
    {
        $transporter = new StreamCommandCallTransporter(
            [
                'command' => Constants::COMMAND_XGROUP,
                'args'    => [
                    'CREATE',
                    $this->_streamName,
                    $groupName,
                    (int) $isShowFullHistoryStream
                ]
            ]
        );

        try {
            return (bool) $this->_client->call($transporter);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}