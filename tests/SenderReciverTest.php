<?php
use MessageQ\Sender;
use MessageQ\Reciver;

class SenderReciverTest extends PHPUnit\Framework\TestCase {

    public function test_config(){
        $config = require_once(__DIR__."/../example/config.php");
        $this->assertTrue(in_array("host", array_keys($config)));
        return $config;
    }

    /**
     * @depends test_config
     */
    public function test_send($config){
        $sender = new Sender([
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
        $this->assertTrue($sender->send("test"));
        $sender = null;
        return $config;
    }

    /**
     * @depends test_send
     */
    public function test_recive($config){
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

        $reciver->recive(function($msg) use(&$recivedMessage){
            $recivedMessage = $msg->body;
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        });

        $this->assertTrue($recivedMessage == "test");
        $reciver = null;
    }
}