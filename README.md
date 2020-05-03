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
  -_messages: array:15 [
    0 => Asiries335\redisSteamPhp\Data\Message^ {#7
      -_id: "1587987159363-0"
      -_key: "job"
      -_body: "[ewrwerwerwerwer]"
    }
    1 => Asiries335\redisSteamPhp\Data\Message^ {#8
      -_id: "1587987173272-0"
      -_key: "job"
      -_body: "[ewrwerwerwerwer1]"
    }
    2 => Asiries335\redisSteamPhp\Data\Message^ {#9
      -_id: "1587987415226-0"
      -_key: "job"
      -_body: "[ewrwerwerwerwer1]"
    }
    3 => Asiries335\redisSteamPhp\Data\Message^ {#10
      -_id: "1588096817666-0"
      -_key: "3424"
      -_body: "234"
    }
    4 => Asiries335\redisSteamPhp\Data\Message^ {#11
      -_id: "1588097384009-0"
      -_key: "213"
      -_body: "12312"
    }
    5 => Asiries335\redisSteamPhp\Data\Message^ {#12
      -_id: "1588097564518-0"
      -_key: "key"
      -_body: "[1,1,1]"
    }
    6 => Asiries335\redisSteamPhp\Data\Message^ {#13
      -_id: "1588097758254-0"
      -_key: "key"
      -_body: "{"id":12,"name":"Ivan","age":25}"
    }
    7 => Asiries335\redisSteamPhp\Data\Message^ {#14
      -_id: "1588098124977-0"
      -_key: "key"
      -_body: "{"id":123,"name":"Ivan","age":25}"
    }
    8 => Asiries335\redisSteamPhp\Data\Message^ {#15
      -_id: "1588098124977-1"
      -_key: "key"
      -_body: "{"id":124,"name":"Ivan1","age":253}"
    }
    9 => Asiries335\redisSteamPhp\Data\Message^ {#16
      -_id: "1588500979608-0"
      -_key: "key"
      -_body: "{"id":123,"name":"Ivan","age":25}"
    }
  ]
}


```

