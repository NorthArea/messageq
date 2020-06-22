<?php declare(strict_types=1);

namespace Northarea\PhpAmqp\Utils;

use Northarea\PhpAmqp\PhpAmqpException;

/**
 * Class Curl
 * @package Npsh\Lib\PhpAmqp\Utils
 */
class Curl
{
    private $url;
    private $options;
    private $validator;

    /**
     * Curl constructor.
     *
     * @param string $url
     * @param array|null $options
     * @throws PhpAmqpException
     */
    public function __construct(string $url, array $options = null)
    {
        $this->validator = new Validator();
        if (!$this->validator->url($url)) {
            throw new PhpAmqpException("Не валидный url", 1);
        }

        $this->url = $url;
        $this->options = $options;
    }

    /**
     * @return array
     * @throws PhpAmqpException
     */
    public function getRequest()
    {
        return $this->curl();
    }

    /**
     * @param mixed|null $params
     *
     * @return array
     * @throws PhpAmqpException
     */
    public function postRequest($params = null)
    {
        $this->options[CURLOPT_POST] = true;

        if (isset($params)) {
            $this->options[CURLOPT_POSTFIELDS] = $params;
        }

        return $this->curl();
    }

    /**
     * @param array $params = null
     * @return array
     * @throws PhpAmqpException
     */
    public function putRequest($params = null): array
    {
        $this->options[CURLOPT_CUSTOMREQUEST] = 'PUT';

        if (isset($params)) {
            $this->options[CURLOPT_POSTFIELDS] = $params;
        }

        return $this->curl();
    }

    /**
     * @return array
     * @throws PhpAmqpException
     */
    private function curl(): array
    {
        $curl = curl_init($this->url);

        //Tell cURL that it should only spend 10 seconds
        //trying to connect to the URL in question.
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);

        //A given cURL operation should only take
        //30 seconds max.
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

        //TRUE для возврата результата передачи в качестве строки из curl_exec()
        //вместо прямого вывода в браузер.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        if (is_array($this->options) && count($this->options) != 0) {
            curl_setopt_array($curl, $this->options);
        }

        $body = curl_exec($curl);
        $head = curl_getinfo($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            throw new PhpAmqpException(
                "Ошибка CURL: " . json_encode($error, JSON_UNESCAPED_UNICODE),
                0
            );
        } else {
            return [
                "head" => $head,
                "body" => $body
            ];
        }
    }
}