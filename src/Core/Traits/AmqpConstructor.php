<?php


namespace Northarea\Messageq\Core\Traits;


use Northarea\Messageq\Core\Amqp;
use PhpAmqpLib\Channel\AMQPChannel;

trait AmqpConstructor
{
    private Amqp $amqp;
    private AMQPChannel $channel;

    public function __construct(Amqp $amqp)
    {
        $this->amqp = $amqp;
        $this->channel = $amqp->getChannel();
    }

    protected function getConnection(): Amqp
    {
        return $this->amqp;
    }

    protected function getChannel(): AMQPChannel
    {
        return $this->channel;
    }
}