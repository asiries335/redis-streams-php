[![Code Intelligence Status](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/badges/build.png?b=master)](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/build-status/master)
This package is for working with Redis streams for php

#
#### **What is implemented in the current version**

At the moment, the package can work with methods: **xadd**, **xread**, **xrevrange**.

The package has functions for adding messages to a stream,
get messages from a stream, 
listening to a stream as event-loop

## Info

Work with Redis occurs through the package Predis
(https://github.com/nrk/predis)

Need version Redis >= 5.0

## Install

`composer require asiries335/redis-stream-php`

## Usage

_Start working_
```php

<?php

// Class predis.
$redisClient = new Redis();
$redisClient->connect('127.0.0.1', '6379');


$client = new \Asiries335\redisSteamPhp\Client($redisClient);
```

_Add a message to stream_

```php

$client->stream('test')->add(
    'key',
    [
        'id'   => 123,
        'name' => 'Barney',
        'age'  => 25,
    ]
);
```

see more https://redis.io/commands/xadd

_Get a collection of messages from the stream_

```php

// Get data from stream.
$collection = $client->stream('test')->get();

// result.

 Asiries335\redisSteamPhp\Data\Collection {
  -_name: "test"
  -_messages: [
    0 => Asiries335\redisSteamPhp\Data\Message {
      -_id: "1588098124977-0"
      -_key: "key"
      -_body: "{"id":123,"name":"Barney","age":25}"
    }
    1 => Asiries335\redisSteamPhp\Data\Message {
      -_id: "1588098124977-1"
      -_key: "key"
      -_body: "{"id":124,"name":"Smith","age":30}"
    }
    2 => Asiries335\redisSteamPhp\Data\Message {
      -_id: "1588500979608-0"
      -_key: "key"
      -_body: "{"id":163,"name":"Alex","age":20}"
    }
  ]
}

```

_Listen to a stream_

```php
$client->stream('test')->listen(
    function (\Asiries335\redisSteamPhp\Data\Message $message) {
        // Your code...
    }
);
```

The method works as event-loop
