<?php declare(strict_types=1);

namespace Northarea\PhpAmqp\Amqp;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use Northarea\PhpAmqp\PhpAmqpException;
use Exception;

/**
 * Class AbstractAmqp
 * @package Npsh\Lib\PhpAmqp\Amqp
 */
abstract class AbstractAmqp
{
    protected $connection;
    protected $channel;

    /**
     * AbstractAmqp constructor.
     * @param array $setting
     * @throws PhpAmqpException
     */
    public function __construct(array $setting)
    {
        try {
            $this->connection = new AMQPStreamConnection(
                $setting['host'], $setting['port'], $setting['user'], $setting['password']
            );
            $this->channel = $this->connection->channel();
        } catch (Exception $exception) {
            throw new PhpAmqpException(
                "Ошибка подключения к серверу очередей: " . $exception->getMessage(),
                2
            );
        }
    }

    /**
     * @param $queue
     */
    public function queueDeclare($queue)
    {
        $this->channel->queue_declare($queue, false, true, false, false);
    }

    /**
     * @throws Exception
     */
    public function __destruct()
    {
        try {
            $this->channel->close();
            $this->connection->close();
        } catch (Exception $exception) {
            throw new PhpAmqpException(
                "Ошибка отключения от сервера: " . $exception->getMessage(),
                2
            );
        }
    }
}