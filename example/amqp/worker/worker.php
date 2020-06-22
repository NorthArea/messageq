<?php declare(strict_types=1);

use Northarea\PhpAmqp\Amqp\AmqpFactory;

require_once __DIR__ . "/../../../vendor/autoload.php";
$config = require_once __DIR__ . "/../../config.php";

$worker = new AmqpFactory(
    $config["host"],
    $config["port_amqp"],
    $config["user"],
    $config["password"]
);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$worker->work("test_worker", function ($msg) {
    var_dump($msg->body);
    // Подтверждение обработки. Выполнить после того, как обработаете таск из  $msg->body
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
});