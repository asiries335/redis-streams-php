# redis-stream-php
This package is for working with Redis streams for php

#
#### **What is implemented in the current version**

At the moment, the package can work with methods: **xadd**, **xread**, **xrevrange**.

The package has functions for adding messages to a stream,
get messages from a stream, 
listening to a stream as event-loop
#
#### **Info**

Work with Redis occurs through the package Predis
(https://github.com/nrk/predis)

Need version Redis >= 5.0
#
#### **Examples of using**

**_start working_**

`<?php

require __DIR__.'/vendor/autoload.php';



$redisClient = new Redis();
$redisClient->connect('127.0.0.1', '6379');


$client = new \Asiries335\redisSteamPhp\Client($redisClient);`