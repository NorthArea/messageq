<?php declare(strict_types=1);

namespace Northarea\PhpAmqp\Http;


use Northarea\PhpAmqp\AbstractFactory;
use Northarea\PhpAmqp\ReceiverInterface;
use Northarea\PhpAmqp\SenderInterface;
use Exception;
use Northarea\PhpAmqp\WorkerInterface;

/**
 * Class HttpFactory
 * @package Npsh\Lib\PhpAmqp\Http
 */
class HttpFactory extends AbstractFactory
{
    /**
     * @return SenderInterface
     */
    protected function getSender(): SenderInterface
    {
        return new Sender($this->setting);
    }

    /**
     * @return ReceiverInterface
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
        throw new Exception("Метод не доступен для HTTP протокола");
    }
}