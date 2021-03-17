<?php

namespace Test\TaskWorker;


use Northarea\Messageq\TaskWorker\Manager;
use Test\TestCase;

class ManagerTest extends TestCase
{
    public function testMain(): void
    {
        $manager = new Manager($this->amqp);
        self::assertTrue($manager->send('queue', 'test'));
    }

}
