<?php

use Asiries335\redisSteamPhp\Listeners\DemoListener;
use Asiries335\redisSteamPhp\Listeners\Manager\TcpListenerEventManager;
use Asiries335\redisSteamPhp\Server\TcpServer;
use Asiries335\redisSteamPhp\ServerProvider;

require_once __DIR__ . '/vendor/autoload.php';

// set server
$tcpServer = new TcpServer();
$tcpServer->setType('tcp');
$tcpServer->setConfig([
    'host' => '0.0.0.0',
    'port' => '1236'
]);

// set listener manager
$tcpListenerEventManager = new TcpListenerEventManager();
$tcpListenerEventManager->setListeners([
    new DemoListener()
]);

// run
$serverProvider = new ServerProvider(
    $tcpServer,
    $tcpListenerEventManager
);

$serverProvider->boot();

