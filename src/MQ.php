<?php namespace Mq;
use PhpAmqpLib\Connection\AMQPStreamConnection;

abstract class Mq {
    protected $channel;
    protected $connection;

    /**
     * Constructor
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection) {
        $this->connection = $connection->connect();
        $this->channel = $this->connection->channel();
    }

    /**
     * Destructor. Close connection fith RabbitMQ
     */
    public function __destruct() {
        if(isset($this->$channel)){
            $this->$channel->close();
            $this->$connection->close();
        }
    }
}