<?php namespace MQ;
use MQ\MQ;

class Reciver extends MQ {
    /**
     * Recive Message
     *
     * @param string $queueName
     * @param boolean $reconnect Durable connection
     * @param Callable $callback
     * @return void
     */
    public function reciveMessage(string $queueName, bool $reconnect = false, Callable $callback) {

        $this->channel->queue_declare($queueName, true, false, false, false);

        $this->channel->basic_consume($queueName, '', false, true, false, false, $callback);

        if($reconnect){
            while (count($this->channel->callbacks)) {
                $this->channel->wait();
            }
        } else {
            $this->channel->wait();
        }
    }

}