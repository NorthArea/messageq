<?php


namespace Northarea\Messageq\RemoteProcedureCall;


use Northarea\Contracts\RemoteProcedureCall\ClientInterface;
use Northarea\Messageq\Core\Traits\AmqpConstructor;
use PhpAmqpLib\Message\AMQPMessage;

class Client implements ClientInterface
{
    use AmqpConstructor;

    public function execute(string $queue, string $params): string
    {
        [$queue_name, ,] = $this->getChannel()
            ->queue_declare("", false, false, true, false);

        $uuid = uniqid(null, true);

        $response = null;

        $callback = function ($rep) use (&$response, $uuid) {
            if ($rep->get('correlation_id') === $uuid) {
                $response = $rep->body;
            }
        };

        $this->getChannel()
            ->basic_consume($queue_name, '', false, true, false, false, $callback);

        $msg = new AMQPMessage(
            $params,
            array(
                'correlation_id' => $uuid,
                'reply_to' => $queue_name
            )
        );

        $this->getChannel()->basic_publish($msg, null, $queue);
        while (!$response) {
            $this->getChannel()->wait();
        }

        return $response;
    }
}
