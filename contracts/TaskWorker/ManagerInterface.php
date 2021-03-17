<?php


namespace Northarea\Contracts\TaskWorker;


use Northarea\Contracts\Core\SenderInterface;

interface ManagerInterface extends SenderInterface
{
    public function send(string $queue, string $data): bool;
}
