<?php

use Asiries335\redisSteamPhp\Consumer\DemoConsumer;
use Asiries335\redisSteamPhp\Consumer\Manager\TcpConsumerManager;
use Asiries335\redisSteamPhp\Server\TcpServer;
use Asiries335\redisSteamPhp\ServerProvider;

require_once __DIR__ . '/vendor/autoload.php';

// set server
$tcpServer = new TcpServer();
$tcpServer->setConfig([
    'host' => '0.0.0.0',
    'port' => '1236'
]);

// set listener manager
$tcpConsumerManager = new TcpConsumerManager();
$tcpConsumerManager->setConsumers([
    new DemoConsumer()
]);

// run
$serverProvider = new ServerProvider(
    $tcpServer,
    $tcpConsumerManager
);

$serverProvider->boot();

