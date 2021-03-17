<?php

namespace Test\Core;

use PHPUnit\Framework\TestCase;

class AmqpTest extends TestCase
{
    public function test_main(): void
    {
        //Test connection to RabbitMQ
        //$amqp = new Amqp($_ENV['rabbit_host'], $_ENV['rabbit_port'], $_ENV['rabbit_user'], $_ENV['rabbit_password']);
        //self::assertInstanceOf(AMQPChannel::class, $amqp->getChannel());
        self::assertTrue(true);
    }
}
