<?php


namespace Northarea\Messageq\TaskWorker;


use Northarea\Contracts\TaskWorker\WorkerInterface;
use Northarea\Messageq\Core\Traits\AmqpConstructor;

class Worker implements WorkerInterface
{
    use AmqpConstructor;

    public function receive(string $queue, callable $callback): void
    {
        $this->getChannel()
            ->queue_declare($queue, false, true, false, false);

        $callback = function ($msg) use($callback) {
            $callback($msg);
            $msg->ack();
        };

        $this->getChannel()->basic_qos(null, 1, null);
        $this->getChannel()
            ->basic_consume($queue, '', false, false, false, false, $callback);

        while ($this->getChannel()->is_consuming()) {
            $this->getChannel()->wait();
        }
    }
}
