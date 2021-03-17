<?php


use Northarea\Messageq\MainFactory;

require_once __DIR__ . "/../../vendor/autoload.php";
$config = require __DIR__ . "/../config.php";

$factory = new MainFactory($config[0], $config[1], $config[2], $config[3]);
$sender = $factory->getTaskWorker()->getManager();
$sender->send('test_work', 'hello world');