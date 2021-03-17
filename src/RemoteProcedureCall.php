<?php


namespace Northarea\Messageq;


use Northarea\Contracts\RemoteProcedureCall\ClientInterface;
use Northarea\Contracts\RemoteProcedureCall\ServerInterface;
use Northarea\Contracts\RemoteProcedureCallInterface;
use Northarea\Messageq\Core\Traits\AmqpConstructor;
use Northarea\Messageq\RemoteProcedureCall\Client;
use Northarea\Messageq\RemoteProcedureCall\Server;

class RemoteProcedureCall implements RemoteProcedureCallInterface
{
    use AmqpConstructor;

    public function getServer(): ServerInterface
    {
        return new Server($this->getConnection());
    }

    public function getClient(): ClientInterface
    {
        return new Client($this->getConnection());
    }
}
