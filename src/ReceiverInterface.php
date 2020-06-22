<?php declare(strict_types=1);


namespace Northarea\PhpAmqp;

/**
 * Interface ReceiverInterface
 * @package Npsh\Lib\PhpAmqp
 */
interface ReceiverInterface
{
    /**
     * @param string $queue
     * @param int $limit
     * @return array
     */
    public function receive(string $queue, int $limit): array;
}