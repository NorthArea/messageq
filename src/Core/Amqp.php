<?php


namespace Northarea\Messageq\Core;


use Northarea\Contracts\Core\AmqpInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Amqp implements AmqpInterface
{
    private AMQPSSLConnection $connection;
    private AMQPChannel $channel;

    public function __construct(string $host, int $port, string $user, string $password)
    {
        $this->connection = new AMQPSSLConnection($host, $port, $user, $password);
        $this->channel = $this->connection->channel();
    }

    public function getConnection(): AMQPStreamConnection
    {
        return $this->connection;
    }

    public function getChannel(): AMQPChannel
    {
        return $this->channel;
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
