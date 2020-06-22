<?php declare(strict_types=1);


namespace Northarea\PhpAmqp\Http;


use Northarea\PhpAmqp\ReceiverInterface;
use Northarea\PhpAmqp\PhpAmqpException;

/**
 * Class Receiver
 * @package Npsh\Lib\PhpAmqp\Http
 */
class Receiver extends AbstractHttp implements ReceiverInterface
{
    /**
     * @param string $queue
     * @param int $limit
     * @return array
     * @throws PhpAmqpException
     */
    public function receive(string $queue, int $limit): array
    {
        $this->queueDeclare($queue);

        try {
            $receiver = $this->curl("/api/queues/{$this->setting['vhost']}/$queue/get");
            $response = $receiver->postRequest(json_encode([
                "count" => $limit,
                "ackmode" => "ack_requeue_false",
                "encoding" => "auto"
            ]));

            if ($response['head']['http_code'] == 200) {
                $temp = [];
                $body = json_decode($response['body'], true);
                foreach ($body as $item) {
                    $temp[] = $item['payload'];
                }
                return $temp;
            } else {
                throw new PhpAmqpException(
                    "http_code: {$response['head']['http_code']} | body: {$response['body']}",
                    3
                );
            }

        } catch (PhpAmqpException $exception) {
            throw new PhpAmqpException("Ошибка получения из очереди " . $exception->getMessage(), 3);
        }
    }

}