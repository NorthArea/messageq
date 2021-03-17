<?php

use Northarea\Messageq\MainFactory;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__ . "/../../vendor/autoload.php";
$config = require __DIR__ . "/../config.php";

$factory = new MainFactory($config[0], $config[1], $config[2], $config[3]);
$listener = $factory->getEventDispatcher()->getListener();
$listener->listen(['kernel.*'], 'kernel', function (AMQPMessage $message) {
    print $message->body;
});