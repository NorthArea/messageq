<?php

use Northarea\Messageq\MainFactory;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__ . "/../../vendor/autoload.php";
$config = require __DIR__ . "/../config.php";

$factory = new MainFactory($config[0], $config[1], $config[2], $config[3]);
$receiver = $factory->getTaskWorker()->getWorker();
$receiver->receive('test_work', function (AMQPMessage $msg) {
    var_dump($msg->body);
});