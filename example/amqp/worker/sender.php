<?php declare(strict_types=1);

use Northarea\PhpAmqp\Amqp\AmqpFactory;

require_once __DIR__ . "/../../../vendor/autoload.php";
$config = require_once __DIR__ . "/../../config.php";

$sender = new AmqpFactory(
    $config["host"],
    $config["port_amqp"],
    $config["user"],
    $config["password"]
);

$sender->send("test_worker", "message");