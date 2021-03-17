<?php


namespace Northarea\Contracts;


use Northarea\Contracts\EventDispatcher\ListenerInterface;
use Northarea\Contracts\EventDispatcher\EmitterInterface;

interface EventDispatcherInterface
{
    public function getEmitter(): EmitterInterface;

    public function getListener(): ListenerInterface;
}
