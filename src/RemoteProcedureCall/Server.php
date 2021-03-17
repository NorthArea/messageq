<?php


namespace Northarea\Messageq\RemoteProcedureCall;


use Northarea\Contracts\RemoteProcedureCall\ServerInterface;
use Northarea\Messageq\Core\Traits\AmqpConstructor;
use PhpAmqpLib\Message\AMQPMessage;

class Server implements ServerInterface
{
    use AmqpConstructor;

    public function execute(string $queue, callable $callback): void
    {
        $this->channel
            ->queue_declare($queue, false, false, false, false);

        $function = function ($req) use ($callback) {
            $msg = new AMQPMessage(
                (string) $callback($req),
                array('correlation_id' => $req->get('correlation_id'))
            );

            $req->delivery_info['channel']->basic_publish($msg, null, $req->get('reply_to'));
            $req->ack();
        };

        $this->getChannel()->basic_qos(null, 1, null);
        $this->getChannel()
            ->basic_consume($queue, '', false, false, false, false, $function);

        while ($this->getChannel()->is_consuming()) {
            $this->getChannel()->wait();
        }
    }
}
