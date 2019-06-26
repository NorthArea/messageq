<?php
use Mq\Connection;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ConnectionTest extends PHPUnit\Framework\TestCase {
    public function test_construct(){
        $config = require(__DIR__.'/../example/config.php');
        $connection = new Connection($config['host'], $config['port'], $config['user'], $config['pwd']);
        $this->assertInstanceOf(Connection::class, $connection);
        return $connection;
    }

    /**
     * @depends test_construct
     */
    public function test_connect($connection) {
        $this->assertInstanceOf(AMQPStreamConnection::class, $connection->connect());
    }
}