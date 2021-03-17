<?php

use Northarea\Messageq\MainFactory;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__ . "/../../vendor/autoload.php";
$config = require __DIR__ . "/../config.php";

$factory = new MainFactory($config[0], $config[1], $config[2], $config[3]);
$server = $factory->getRpc()->getServer();
$server->execute('rpc_test', function (AMQPMessage $message) {
    $array = json_decode($message->body, true, 512, JSON_THROW_ON_ERROR);
    return array_reduce($array, function ($carry, int $item) {
        $carry += $item;
        return $carry;
    });
});