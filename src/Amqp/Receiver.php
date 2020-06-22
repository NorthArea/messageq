<?php declare(strict_types=1);

namespace Northarea\PhpAmqp\Amqp;


use Northarea\PhpAmqp\ReceiverInterface;
use Northarea\PhpAmqp\PhpAmqpException;
use PhpAmqpLib\Exception\AMQPTimeoutException;
use ErrorException;

/**
 * Class Receiver
 * @package Npsh\Lib\PhpAmqp\Amqp
 */
class Receiver extends AbstractAmqp implements ReceiverInterface
{
    /**
     * @param string $queue
     * @param int $limit
     * @return array
     * @throws PhpAmqpException
     */
    public function receive(string $queue, int $limit): array
    {
        $this->queueDeclare($queue);
        $temp = [];

        $callback = function ($msg) use (&$temp) {
            $temp[] = $msg->body;
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        try {
            $this->channel->basic_qos(null, 1, null);

            $this->channel->basic_consume($queue, '', false, false, false, false, $callback);

            while ($limit > 0) {
                $limit--;
                try {
                    $this->channel->wait(null, false, 1);
                } catch (AMQPTimeoutException $exception) {
                    break;
                }
            }

        } catch (ErrorException $exception) {
            throw new PhpAmqpException(
                "Ошибка получнеия данных из очереди " . $exception->getMessage(),
                2);
        }

        return $temp;
    }

}