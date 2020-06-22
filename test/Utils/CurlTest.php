<?php declare(strict_types=1);

namespace Test\Utils;

use Northarea\PhpAmqp\PhpAmqpException;
use Northarea\PhpAmqp\Utils\Curl;
use PHPUnit\Framework\TestCase;

/**
 * Class CurlTest
 * @package Npsh\Lib\PhpAmqp\Test\Utils
 */
class CurlTest extends TestCase
{
    public function testCreate() {
        $google = new Curl("https://www.google.com");
        $this->assertTrue(is_a($google, Curl::class));
        $this->expectException(PhpAmqpException::class);
        new Curl("string");
    }

    public function testGet() {
        $google = new Curl("https://www.google.com");
        $this->assertTrue(array_key_exists("head", $google->getRequest()));
        $this->assertTrue(array_key_exists("body", $google->getRequest()));
    }

    public function testPost() {
        $json = new Curl("http://jsonplaceholder.typicode.com/posts");
        $this->assertTrue($json->postRequest()['head']['http_code'] == 201);
    }

    public function testPut()
    {
        $json = new Curl("http://jsonplaceholder.typicode.com/posts/1");
        $this->assertTrue($json->putRequest()['head']['http_code'] == 200);
    }
}
