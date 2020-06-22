<?php declare(strict_types=1);

namespace Northarea\PhpAmqp\Amqp;


use Northarea\PhpAmqp\SenderInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Northarea\PhpAmqp\PhpAmqpException;
use Exception;

/**
 * Class Sender
 * @package Npsh\Lib\PhpAmqp\Amqp
 */
class Sender extends AbstractAmqp implements SenderInterface
{
    /**
     * @param string $queue
     * @param string $message
     * @return bool
     * @throws PhpAmqpException
     */
    public function send(string $queue, string $message): bool
    {
        $this->queueDeclare($queue);

        $message = new AMQPMessage(
            $message, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]
        );

        try {
            $this->channel->basic_publish($message, '', $queue);
            return true;
        } catch (Exception $exception) {
            throw new PhpAmqpException("Ошибка отправки сообщения " . $exception->getMessage(), 2);
        }
    }

}