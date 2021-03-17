<?php


namespace Northarea\Contracts\EventDispatcher;


use Northarea\Contracts\Core\SenderInterface;

interface EmitterInterface extends SenderInterface
{
    public function emit(string $routingKey, string $exchanger, string $data): bool;
}
