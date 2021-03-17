<?php


namespace Northarea\Messageq;


use Northarea\Contracts\TaskWorker\WorkerInterface;
use Northarea\Contracts\TaskWorker\ManagerInterface;
use Northarea\Contracts\TaskWorkerInterface;
use Northarea\Messageq\Core\Traits\AmqpConstructor;
use Northarea\Messageq\TaskWorker\Worker;
use Northarea\Messageq\TaskWorker\Manager;

class TaskWorker implements TaskWorkerInterface
{
    use AmqpConstructor;

    public function getWorker(): WorkerInterface
    {
        return new Worker($this->getConnection());
    }

    public function getManager(): ManagerInterface
    {
        return new Manager($this->getConnection());
    }
}
