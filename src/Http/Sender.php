<?php declare(strict_types=1);


namespace Northarea\PhpAmqp\Http;


use Northarea\PhpAmqp\PhpAmqpException;
use Northarea\PhpAmqp\SenderInterface;

/**
 * Class Sender
 * @package Npsh\Lib\PhpAmqp\Http
 */
class Sender extends AbstractHttp implements SenderInterface
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

        try {
            $sender = $this->curl("/api/exchanges/{$this->setting["vhost"]}/amq.default/publish");

            $response = $sender->postRequest(json_encode([
                "routing_key" => $queue,
                "payload" => $message,
                "payload_encoding" => "string",
                "properties" => json_decode("{}")
            ]));

            if ($response['body'] == '{"routed":true}') {
                return true;
            } else {
                throw new PhpAmqpException(
                    "http_code: {$response['head']['http_code']} | body: {$response['body']}",
                    3
                );
            }
        } catch (PhpAmqpException $exception) {
            throw new PhpAmqpException("Ошибка отправки сообщения " . $exception->getMessage(), 3);
        }
    }
}