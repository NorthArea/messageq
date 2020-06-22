<?php declare(strict_types=1);


namespace Northarea\PhpAmqp;

/**
 * Class AbstractFactory
 * @package Npsh\Lib\PhpAmqp
 */
abstract class AbstractFactory
{
    protected $setting;

    /**
     * AbstractFactory constructor.
     * @param string $host
     * @param int $port
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, int $port, string $user, string $password)
    {
        $this->setting = [
            "host" => $host,
            "port" => $port,
            "user" => $user,
            "password" => $password,
        ];
    }

    /**
     * @return SenderInterface
     */
    abstract protected function getSender(): SenderInterface;

    /**
     * @param string $queue
     * @param string $message
     * @return bool
     */
    public function send(string $queue, string $message): bool
    {
        return $this->getSender()->send($queue, $message);
    }

    /**
     * @return ReceiverInterface
     */
    abstract protected function getReceiver(): ReceiverInterface;

    /**
     * @param string $queue
     * @param int $limit = 1
     * @return array
     */
    public function receive(string $queue, int $limit = 1): array
    {
        return $this->getReceiver()->receive($queue, $limit);
    }

    /**
     * @return mixed
     */
    abstract protected function getWorker(): WorkerInterface;

    /**
     * @param string $queue
     * @param callable $callback
     */
    public function work(string $queue, callable $callback): void
    {
        $worker = $this->getWorker();
        $worker->work($queue, $callback);
    }
}