<?php


namespace Test;


use Northarea\Messageq\Core\Amqp;
use PhpAmqpLib\Channel\AMQPChannel;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $amqp;

    protected function setUp(): void
    {
        parent::setUp();
        $this->amqp = $this->createMock(Amqp::class);
        $channel = $this->createMock(AMQPChannel::class);
        $channel->method('queue_declare')->willReturn(true);
        $channel->method('basic_publish')->willReturn(true);

        $this->amqp->method('getChannel')->willReturn($channel);
    }
}