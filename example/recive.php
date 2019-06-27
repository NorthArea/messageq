<?php require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once('config.php');

use Mq\Sender;
use Mq\Reciver;
use Mq\Connection;

$connection = new Connection($config['host'], $config['port'], $config['user'], $config['pwd']);
$reciver = new Reciver($connection);

//Принять одно сообщение
$reciver->reciveMessage("test", false, function($msg) {
    echo "Message: ".$msg->body;
});

//$str = new Object();
//Принять одно сообщение 2
//$reciver->reciveMessage("test", false, function($msg) use($str) {
//    var_dump($str);
//    echo "Message: ".$msg->body;
//});

//Слушает порт
//$reciver->reciveMessage("test", true, function($msg) {
//    echo "Message: ".$msg->body;
//});