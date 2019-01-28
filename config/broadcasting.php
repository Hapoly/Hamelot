<?php

return [

  /*
  |--------------------------------------------------------------------------
  | Default Broadcaster
  |--------------------------------------------------------------------------
  |
  | This option controls the default broadcaster that will be used by the
  | framework when an event needs to be broadcast. You may set this to
  | any of the connections defined in the "connections" array below.
  |
  | Supported: "pusher", "redis", "log", "null"
  |
   */

  'default' => env('BROADCAST_DRIVER', 'null'),

  /*
  |--------------------------------------------------------------------------
  | Broadcast Connections
  |--------------------------------------------------------------------------
  |
  | Here you may define all of the broadcast connections that will be used
  | to broadcast events to other systems or over websockets. Samples of
  | each available type of connection are provided inside this array.
  |
   */

  'connections' => [

    'mysql' => [
      'driver' => 'mysql',
      'host' => env('DB_HOST', '127.0.0.1'),
      'port' => env('DB_PORT', '3306'),
      'database' => env('DB_DATABASE', 'forge'),
      'username' => env('DB_USERNAME', 'forge'),
      'password' => env('DB_PASSWORD', ''),
      'unix_socket' => env('DB_SOCKET', ''),
      'charset' => 'utf8mb4',
      'collation' => 'utf8mb4_unicode_ci',
      'prefix' => '',
      'strict' => true,
      'engine' => null,
      'options' => [
        \PDO::ATTR_EMULATE_PREPARES => true,
      ],
    ],
    'pusher' => [
      'driver' => 'pusher',
      'key' => env('PUSHER_APP_KEY'),
      'secret' => env('PUSHER_APP_SECRET'),
      'app_id' => env('PUSHER_APP_ID'),
      'options' => [
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'encrypted' => true,
      ],
    ],

    'redis' => [
      'driver' => 'redis',
      'connection' => 'default',
    ],

    'log' => [
      'driver' => 'log',
    ],

    'null' => [
      'driver' => 'null',
    ],

  ],

];
