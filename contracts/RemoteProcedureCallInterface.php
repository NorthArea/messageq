<?php


namespace Northarea\Contracts;


use Northarea\Contracts\RemoteProcedureCall\ClientInterface;
use Northarea\Contracts\RemoteProcedureCall\ServerInterface;

interface RemoteProcedureCallInterface
{
    public function getServer(): ServerInterface;

    public function getClient(): ClientInterface;
}
