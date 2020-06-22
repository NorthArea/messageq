<?php declare(strict_types=1);

namespace Northarea\PhpAmqp\Http;


use Northarea\PhpAmqp\Utils\Curl;
use Northarea\PhpAmqp\PhpAmqpException;

/**
 * Class AbstractHttp
 * @package Npsh\Lib\PhpAmqp\Http
 */
class AbstractHttp
{
    protected $setting;

    /**
     * AbstractHttp constructor.
     * @param array $setting
     */
    public function __construct(array $setting)
    {
        $this->setting = $setting;
        $this->setting["vhost"] = "%2F";
        $this->setting["baseUrl"] = "http://{$this->setting['host']}:{$this->setting['port']}";
    }

    /**
     * @param $url
     * @return Curl
     * @throws PhpAmqpException
     */
    protected function curl($url)
    {
        return new Curl(
            $this->setting["baseUrl"] . $url,
            [
                CURLOPT_USERPWD => "{$this->setting["user"]}:{$this->setting["password"]}",
                CURLOPT_HTTPHEADER => ['Content-Type:application/json'],
            ]
        );
    }

    /**
     * @param string $queueName
     * @return bool
     * @throws PhpAmqpException
     */
    protected function queueDeclare($queueName)
    {
        //{"auto_delete":false,"durable":true,"arguments":{},"node":"rabbit@smacmullen"}
        $queue = new Curl(
            "{$this->setting["baseUrl"]}/api/queues/{$this->setting["vhost"]}/{$queueName}",
            [
                CURLOPT_USERPWD => "{$this->setting["user"]}:{$this->setting["password"]}",
                CURLOPT_HTTPHEADER => ['Content-Type:application/json'],
            ]);
        $response = $queue->putRequest(json_encode([
            "auto_delete" => false,
            "durable" => true
        ]));

        $code = $response['head']['http_code'];

        if ($code == "201" || "204") {
            return true;
        } else {
            throw new PhpAmqpException(
                "Ошибка добавления новой очереди {$response['head']['http_code']}".
                " | body: {$response['body']}",
                3
            );
        }
    }
}