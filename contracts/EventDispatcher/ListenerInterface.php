<?php


namespace Northarea\Contracts\EventDispatcher;


use Northarea\Contracts\Core\ReceiverInterface;

interface ListenerInterface extends ReceiverInterface
{
    public function listen(array $bindingKeys, string $exchanger, callable $callback): void;
}
