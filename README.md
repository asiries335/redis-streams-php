[![Code Intelligence Status](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/badges/build.png?b=master)](https://scrutinizer-ci.com/g/asiries335/redis-streams-php/build-status/master)

#
This package is for working with Redis streams for php

## Features

1. add messages in a stream
2. delete messages from a stream
3. find a message by the id of the message from a stream
4. get a collection of a message from a stream
5. create a group consumer for stream
6. delete a group consumer from stream
7. delete a consumer from a group 
8. listen to a stream, implemented based on (https://github.com/reactphp/event-loop)

## Info

Need version Redis >= 5.0

## Install

`composer require asiries335/redis-stream-php`

## Usage

_Start working_
```php

<?php
use Asiries335\redisSteamPhp\Dto\StreamCommandCallTransporter;

// Example use in your app.
class Config implements \Asiries335\redisSteamPhp\ClientRedisStreamPhpInterface {

    private $client;

    public function __construct()
    {
        $this->client = new \Redis();
        $this->client->connect('127.0.0.1', '6379');
    }

    /**
     * Method for run command of redis
     *
     * @param StreamCommandCallTransporter $commandCallTransporter
     *
     * @return mixed
     *
     * @throws \Dto\Exceptions\InvalidDataTypeException
     * @throws \Dto\Exceptions\InvalidKeyException
     */
    public function call(StreamCommandCallTransporter $commandCallTransporter)
    {
        // Example use.
        return $this->client->rawCommand(
            $commandCallTransporter->get('command')->toScalar(),
            ...$commandCallTransporter->get('args')->toArray()
        );
    }
}

$client = new \Asiries335\redisSteamPhp\Client(new Config());
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

_Find a message by id_

```php

$message = $client->stream('test')->findById('1599404282894-0');

// result.
Asiries335\redisSteamPhp\Data\Message {
  -_id: "1599404282894-0"
  -_key: "user"
  -_body: "{"id":123,"name":"Barney","age":25}"
}

```

_Delete a message_

```php
$client->stream('test')->delete('key');
```

see more https://redis.io/commands/xdel

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

functional works on a package basis https://github.com/reactphp/event-loop

```php
$client->stream('test')->listen(
    function (\Asiries335\redisSteamPhp\Data\Message $message) {
        // Your code...
    }
);
```


_Create a new consumer group_

```php
$streamName = 'test';
$groupName  = 'demo-group-1';
$isShowFullHistoryStream = false;

// return bool or ErrorException.
$client->streamGroupConsumer($streamName)->create($groupName, $isShowFullHistoryStream);
```

_Destroy a consumer group_

```php
$streamName = 'test';
$groupName  = 'demo-group-1';

// return bool or ErrorException.
$client->streamGroupConsumer($streamName)->destroy($groupName);
```

_Delete a consumer from a group_
```php
$streamName = 'test';
$groupName  = 'demo-group-1';
$consumerName = 'consumer-name';

// return bool or ErrorException.
$client->streamGroupConsumer($streamName)->deleteConsumer($groupName, $consumerName);
```