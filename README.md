# redis-stream-php
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

## Usage

_start working_
```php

<?php

require __DIR__.'/vendor/autoload.php';



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
        'name' => 'Ivan',
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

 Asiries335\redisSteamPhp\Data\Collection^ {#6
  -_name: "test"
  -_messages:  [
    0 => Asiries335\redisSteamPhp\Data\Message^ {
      -_id: "1587987159363-0"
      -_key: "job"
      -_body: "[ewrwerwerwerwer]"
    }
    1 => Asiries335\redisSteamPhp\Data\Message^ {
      -_id: "1587987173272-0"
      -_key: "job"
      -_body: "[ewrwerwerwerwer1]"
    }
    2 => Asiries335\redisSteamPhp\Data\Message^ {
      -_id: "1587987415226-0"
      -_key: "job"
      -_body: "[ewrwerwerwerwer1]"
    }
    3 => Asiries335\redisSteamPhp\Data\Message^ {
      -_id: "1588096817666-0"
      -_key: "3424"
      -_body: "234"
    }
    4 => Asiries335\redisSteamPhp\Data\Message^ {
      -_id: "1588097384009-0"
      -_key: "213"
      -_body: "12312"
    }
    5 => Asiries335\redisSteamPhp\Data\Message^ {
      -_id: "1588097564518-0"
      -_key: "key"
      -_body: "[1,1,1]"
    }
  ]
}


```

