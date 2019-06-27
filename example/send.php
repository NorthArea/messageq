<?php require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once('config.php');

use Mq\Sender;
use Mq\Reciver;
use Mq\Connection;

$connection = new Connection($config['host'], $config['port'], $config['user'], $config['pwd']);
$sender = new Sender($connection);
$sender->sendMessage("test", "test");