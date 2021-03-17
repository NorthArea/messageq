<?php


use Northarea\Messageq\MainFactory;

require_once __DIR__ . "/../../vendor/autoload.php";
$config = require __DIR__ . "/../config.php";

$factory = new MainFactory($config[0], $config[1], $config[2], $config[3]);
$emitter = $factory->getEventDispatcher()->getEmitter();
$emitter->emit('kernel.error', 'kernel', 'some error');