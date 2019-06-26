<?php
use Mq\Sender;
use Mq\Reciver;
use Mq\Connection;

class SenderReciverTest extends PHPUnit\Framework\TestCase {
    public function test_connect() {
        $config = require(__DIR__.'/../example/config.php');
        $connection = new Connection($config['host'], $config['port'], $config['user'], $config['pwd']);
        $this->assertInstanceOf(Connection::class, $connection);
        return $connection;
    }

    /**
     * @depends test_connect
     */
    public function test_sendMessage($connection) {
        $sender = new Sender($connection);
        $this->assertTrue($sender->sendMessage("test", "test"));
    }

    /**
     * @depends test_connect
     */
    public function test_reciveMessage($connection) {
        $reciver = new Reciver($connection);

        $test = false;

        $reciver->reciveMessage("test", false, function($msg) use(&$test) {
            $test = true;
        });

        $this->assertTrue($test);
    }
}