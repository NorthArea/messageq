<?php


use Northarea\Messageq\MainFactory;

require_once __DIR__ . "/../../vendor/autoload.php";
$config = require __DIR__ . "/../config.php";

$factory = new MainFactory($config[0], $config[1], $config[2], $config[3]);
$client = $factory->getRpc()->getClient();
$result = $client->execute('rpc_test', json_encode([1, 2, 6, 33, 11, 1], JSON_THROW_ON_ERROR));
var_dump($result);