<?php namespace MessageQ;

use PhpAmqpLib\Message\AMQPMessage;

class Sender extends AbstractHandler {
    public function send(string $str) :bool {
        $msg = new AMQPMessage(
            $str,
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );
        
        $this->channel->basic_publish($msg, '', $this->queue);
        return true;
    }
}