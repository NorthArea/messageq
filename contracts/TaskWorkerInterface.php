<?php


namespace Northarea\Contracts;



use Northarea\Contracts\TaskWorker\ManagerInterface;
use Northarea\Contracts\TaskWorker\WorkerInterface;

interface TaskWorkerInterface
{
    public function getWorker(): WorkerInterface;

    public function getManager(): ManagerInterface;
}
