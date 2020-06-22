<?php declare(strict_types=1);


namespace Northarea\PhpAmqp;

use Exception;
use Throwable;

/**
 * Class PhpAmqpException
 * @package Npsh\Lib\PhpAmqp
 */
class PhpAmqpException extends Exception
{
    /**
     * PhpAmqpException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, int $code, Throwable $previous = null)
    {
        if ($code == 0) {
            $message = "Внутренняя ошибка: " . $message;
        } elseif ($code == 1) {
            $message = "Ошибка в классе утилит: " . $message;
        } elseif ($code == 2) {
            $message = "Ошибка AMQP протокола: " . $message;
        } elseif ($code == 3) {
            $message = "Ошибка HTTP протокола: " . $message;
        }

        parent::__construct($message, $code, $previous);
    }
}