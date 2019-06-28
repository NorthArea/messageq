<?php require_once __DIR__ . '/../vendor/autoload.php';

use MessageQ\Reciver;

$config = require_once(__DIR__."/config.php");

$reciver = new Reciver([
    "connection" => [
        "host"      => $config['host'],
        "port"      => $config['port'],
        "user"      => $config['user'],
        "password"  => $config['pwd']
    ],
    "queue" => [
        "name"      => "test",
        "durable"   => true
    ]
]);

$recivedMessage = null;

//Once
$reciver->recive(function($msg) use(&$recivedMessage){
    $recivedMessage = $msg->body;
    echo $recivedMessage;
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
});

/* $reciver->recive(function($msg) use($recivedMessage){
    $recivedMessage = $msg->body;
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
},true); */