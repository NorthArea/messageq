<?php declare(strict_types=1);

namespace Northarea\PhpAmqp\Amqp;


use Northarea\PhpAmqp\WorkerInterface;
use ErrorException;
use Northarea\PhpAmqp\PhpAmqpException;

/**
 * Class Worker
 * @package Npsh\Lib\PhpAmqp\Amqp
 */
class Worker extends AbstractAmqp implements WorkerInterface
{
    /**
     * @param string $queue
     * @param callable $callback
     * @throws PhpAmqpException
     */
    public function work(string $queue, callable $callback): void
    {
        $this->queueDeclare($queue);

        try {
            $this->channel->basic_qos(null, 1, null);

            $this->channel->basic_consume($queue, '', false, false, false, false, $callback);

            while ($this->channel->is_consuming()) {
                $this->channel->wait();
            }

        } catch (ErrorException $exception) {
            throw new PhpAmqpException(
                "Ошибка в работе воркера: " . $exception->getMessage(),
                2
            );
        }
    }

}