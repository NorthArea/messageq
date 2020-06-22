<?php declare(strict_types=1);

namespace Northarea\PhpAmqp\Amqp;


use Northarea\PhpAmqp\AbstractFactory;
use Northarea\PhpAmqp\ReceiverInterface;
use Northarea\PhpAmqp\SenderInterface;
use Exception;
use Northarea\PhpAmqp\WorkerInterface;

/**
 * Class AmqpFactory
 * @package Npsh\Lib\PhpAmqp\Amqp
 */
class AmqpFactory extends AbstractFactory
{
    /**
     * @return SenderInterface
     * @throws Exception
     */
    protected function getSender(): SenderInterface
    {
        return new Sender($this->setting);
    }

    /**
     * @return ReceiverInterface
     * @throws Exception
     */
    protected function getReceiver(): ReceiverInterface
    {
        return new Receiver($this->setting);
    }

    /**
     * @return WorkerInterface
     * @throws Exception
     */
    protected function getWorker(): WorkerInterface
    {
        return new Worker($this->setting);
    }

}