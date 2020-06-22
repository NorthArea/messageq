<?php declare(strict_types=1);


use Northarea\PhpAmqp\Amqp\AmqpFactory;

require_once __DIR__ . "/../../vendor/autoload.php";
$config = require_once __DIR__ . "/../config.php";

$amqp = new AmqpFactory(
    $config["host"],
    $config["port_amqp"],
    $config["user"],
    $config["password"]
);

$amqp->send("test_example", "message1");
$amqp->send("test_example", "message2");
var_dump($amqp->receive("test_example", 2));