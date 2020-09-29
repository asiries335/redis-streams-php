<?php
declare(strict_types=1);

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
                    Constants::COMMAND_OPTION_XGROUP_CREATE,
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

    /**
     * Delete group Consumer
     *
     * @param string $groupName
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function destroy(string $groupName) : bool
    {
        $transporter = new StreamCommandCallTransporter(
            [
                'command' => Constants::COMMAND_XGROUP,
                'args'    => [
                    Constants::COMMAND_OPTION_XGROUP_DESTROY,
                    $this->_streamName,
                    $groupName,
                ]
            ]
        );

        try {
            return (bool) $this->_client->call($transporter);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Delete consumer from group
     *
     * @param string $groupName
     * @param string $consumerName
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function deleteConsumer(string $groupName, string $consumerName) : bool
    {
        $transporter = new StreamCommandCallTransporter(
            [
                'command' => Constants::COMMAND_XGROUP,
                'args'    => [
                    Constants::COMMAND_OPTION_XGROUP_DELCONSUMER,
                    $this->_streamName,
                    $groupName,
                    $consumerName
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