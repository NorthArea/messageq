<?php


namespace Northarea\Contracts\RemoteProcedureCall;


use Northarea\Contracts\Core\ReceiverInterface;

interface ServerInterface extends ReceiverInterface
{
    public function execute(string $queue, callable $callback): void;
}
