<?php namespace MessageQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Reciver extends AbstractHandler {
    public function recive(Callable $callback, bool $reconnect = false){
        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume($this->queue, '', false, false, false, false, $callback);

        $this->channel->wait();
        
        if($reconnect){
            while (count($this->channel->callbacks)) {
                $this->channel->wait();
            }
        }
    }
}