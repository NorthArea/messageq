<?php


namespace Northarea\Messageq\EventDispatcher;


use Northarea\Contracts\EventDispatcher\ListenerInterface;
use Northarea\Messageq\Core\Traits\AmqpConstructor;

class Listener implements ListenerInterface
{
    use AmqpConstructor;

    public function listen(array $bindingKeys, string $exchanger, callable $callback): void
    {
        $this->getChannel()
            ->exchange_declare($exchanger, 'topic', false, false, false);

        [$queue_name, ,] = $this->getChannel()
            ->queue_declare(null, false, false, true, false);

        foreach ($bindingKeys as $key) {
            $this->getChannel()->queue_bind($queue_name, $exchanger, $key);
        }

        $this->getChannel()
            ->basic_consume($queue_name, '', false, true, false, false, $callback);

        while ($this->getChannel()->is_consuming()) {
            $this->getChannel()->wait();
        }
    }
}
