<?php

namespace Test\EventDispatcher;

use Northarea\Messageq\EventDispatcher\Listener;
use Test\TestCase;
use PhpAmqpLib\Message\AMQPMessage;

class ListenerTest extends TestCase
{
    public function testMain(): void
    {
        $listener = new Listener($this->amqp);
        $listener->listen(['*.test'], 'test', function (AMQPMessage $message) {
            print $message->body;
        });
        self::assertTrue(true);
    }

}
