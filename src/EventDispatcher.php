<?php


namespace Northarea\Messageq;


use Northarea\Contracts\EventDispatcher\ListenerInterface;
use Northarea\Contracts\EventDispatcher\EmitterInterface;
use Northarea\Contracts\EventDispatcherInterface;
use Northarea\Messageq\Core\Traits\AmqpConstructor;
use Northarea\Messageq\EventDispatcher\Listener;
use Northarea\Messageq\EventDispatcher\Emitter;

class EventDispatcher implements EventDispatcherInterface
{
    use AmqpConstructor;

    public function getEmitter(): EmitterInterface
    {
        return new Emitter($this->getConnection());
    }

    public function getListener(): ListenerInterface
    {
        return new Listener($this->getConnection());
    }
}
