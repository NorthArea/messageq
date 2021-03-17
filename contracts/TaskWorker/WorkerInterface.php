<?php


namespace Northarea\Contracts\TaskWorker;


use Northarea\Contracts\Core\ReceiverInterface;

interface WorkerInterface extends ReceiverInterface
{
    public function receive(string $queue, callable $callback): void;
}
