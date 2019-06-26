<?php namespace Mq;
use Mq\Mq;
use PhpAmqpLib\Message\AMQPMessage;

class Sender extends Mq {

    /**
     * Send Message
     *
     * @param string $queueName
     * @param string $message
     * @return boolean
     */
    public function sendMessage(string $queueName, string $message) :bool {
        $this->channel->queue_declare($queueName, true, false, false, false);
        $msg = new AMQPMessage($message);

        $this->channel->basic_publish($msg, '', $queueName);
        return true;
    }
}