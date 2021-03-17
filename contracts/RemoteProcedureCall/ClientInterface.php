<?php


namespace Northarea\Contracts\RemoteProcedureCall;


use Northarea\Contracts\Core\SenderInterface;

interface ClientInterface extends SenderInterface
{
    public function execute(string $queue, string $params): string;
}
