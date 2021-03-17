<?php


namespace Northarea\Messageq\TaskWorker;


use Northarea\Contracts\TaskWorker\ManagerInterface;
use Northarea\Messageq\Core\Traits\AmqpConstructor;
use PhpAmqpLib\Message\AMQPMessage;

class Manager implements ManagerInterface
{
    use AmqpConstructor;

    public function send(string $queue, string $data): bool
    {
        $this->getChannel()
            ->queue_declare($queue, false, true, false, false);

        $msg = new AMQPMessage(
            $data,
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $this->getChannel()->basic_publish($msg, null, $queue);

        return true;
    }
}
