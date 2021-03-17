<?php

namespace Test\EventDispatcher;


use Northarea\Messageq\EventDispatcher\Emitter;
use Test\TestCase;

class EmitterTest extends TestCase
{
    public function testMain(): void
    {
        $emitter = new Emitter($this->amqp);
        self::assertTrue($emitter->emit('test.*', 'test', 'test'));
    }

}
