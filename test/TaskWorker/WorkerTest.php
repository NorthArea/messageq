<?php

namespace Test\TaskWorker;

use Northarea\Messageq\TaskWorker\Worker;
use Test\TestCase;
use PhpAmqpLib\Message\AMQPMessage;

class WorkerTest extends TestCase
{
    public function testMain(): void
    {
        $worker = new Worker($this->amqp);
        $worker->receive('queue', function (AMQPMessage $message) {
            print $message->body;
        });
        self::assertTrue(true);
    }

}
