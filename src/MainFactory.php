<?php


namespace Northarea\Messageq;


use Northarea\Contracts\EventDispatcherInterface;
use Northarea\Contracts\RemoteProcedureCallInterface;
use Northarea\Contracts\TaskWorkerInterface;
use Northarea\Messageq\Core\Amqp;

class MainFactory
{
    private Amqp $amqp;

    public function __construct(string $host, int $port, string $user, string $password)
    {
        $this->amqp = new Amqp($host, $port, $user, $password);
    }

    public function getTaskWorker(): TaskWorkerInterface
    {
        return new TaskWorker($this->amqp);
    }

    public function getRpc(): RemoteProcedureCallInterface
    {
        return new RemoteProcedureCall($this->amqp);
    }

    public function getEventDispatcher(): EventDispatcherInterface
    {
        return new EventDispatcher($this->amqp);
    }
}