<?php


namespace Northarea\Messageq\EventDispatcher;


use Northarea\Contracts\EventDispatcher\EmitterInterface;
use Northarea\Messageq\Core\Traits\AmqpConstructor;
use PhpAmqpLib\Message\AMQPMessage;

class Emitter implements EmitterInterface
{
    use AmqpConstructor;

    public function emit(string $routingKey, string $exchanger, string $data): bool
    {
        $this->getChannel()
            ->exchange_declare($exchanger, 'topic', false, false, false);

        $msg = new AMQPMessage($data);

        $this->getChannel()->basic_publish($msg, $exchanger, $routingKey);

        return true;
    }
}
