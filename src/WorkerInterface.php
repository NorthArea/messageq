<?php declare(strict_types=1);

namespace Northarea\PhpAmqp;

/**
 * Interface WorkerInterface
 * @package Npsh\Lib\PhpAmqp
 */
interface WorkerInterface
{
    /**
     * @param string $queue
     * @param callable $callback
     * @return mixed
     */
    public function work(string $queue, callable $callback): void;
}