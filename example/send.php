<?php require_once __DIR__ . '/../vendor/autoload.php';

use MessageQ\Sender;

$config = require_once(__DIR__."/config.php");

$sender = new Sender([
    "connection" => [
        "host"      => $config['host'],
        "port"      => $config['port'],
        "user"      => $config['user'],
        "password"  => $config['pwd']
    ],
    "queue" => [
        "name"      => "test",
        "durable"   => true
    ]
]);

while(true){
    $sender->send("test");
    echo "Send message\n";
    sleep(4);
}