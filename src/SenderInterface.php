<?php declare(strict_types=1);

namespace Northarea\PhpAmqp;

/**
 * Interface SenderInterface
 * @package Npsh\Lib\PhpAmqp
 */
interface SenderInterface
{
    /**
     * @param string $queue
     * @param string $message
     * @return bool
     */
    public function send(string $queue, string $message): bool;
}