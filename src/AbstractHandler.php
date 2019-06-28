<?php namespace MessageQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;

abstract class AbstractHandler {
    protected $connection;
    protected $channel;
    protected $queue;

    public function __construct(array $array){
        if(!isset($array['connection'])){
            throw new exception("Сonnection settings are not specified");
        }
        $this->connection = new AMQPStreamConnection($array['connection']['host'], $array['connection']['port'], $array['connection']['user'], $array['connection']['password']);
        $this->channel = $this->connection->channel();

        $this->queue = $array['queue']['name'];
        $this->channel->queue_declare($this->queue, false, $array['queue']['durable'], false, false);
    }

    public function __destruct(){
        $this->channel->close();
        $this->connection->close();
    }
}