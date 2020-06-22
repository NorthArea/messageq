<?php declare(strict_types=1);

namespace Test;

use Northarea\PhpAmqp\Amqp\AmqpFactory;
use Northarea\PhpAmqp\Http\HttpFactory;
use PHPUnit\Framework\TestCase;
use Northarea\PhpAmqp\PhpAmqpException;

/**
 * Class MainTest
 * @package Npsh\Lib\PhpAmqp\Test
 */
class MainTest extends TestCase
{
    private $config;

    public function setUp(): void
    {
        parent::setUp();
        $this->config = require __DIR__ . "/../example/config.php";
    }

    public function testAmqp()
    {
        $amqp = new AmqpFactory(
            $this->config["host"],
            $this->config["port_amqp"],
            $this->config["user"],
            $this->config["password"]
        );

        $this->assertTrue($amqp->send("test_amqp", "message"));
        $this->assertEquals("message", $amqp->receive("test_amqp")[0]);
    }

    public function testHttp()
    {
        $http = new HttpFactory(
            $this->config["host"],
            $this->config["port_http"],
            $this->config["user"],
            $this->config["password"]
        );

        $this->assertTrue($http->send("test_http", "message"));
        $this->assertEquals("message", $http->receive("test_http", 1)[0]);
    }

    public function testException1()
    {
        $this->expectException(PhpAmqpException::class);
        $sender = new AmqpFactory(
            $this->config["host"],
            $this->config["port_amqp"],
            $this->config["user"],
            "wrongPassword"
        );
        $this->assertTrue($sender->send("test_amqp", "message"));
    }

    public function testException2()
    {
        $this->expectException(PhpAmqpException::class);
        $sender = new HttpFactory(
            $this->config["host"],
            $this->config["port_http"],
            $this->config["user"],
            "wrongPassword"
        );
        $this->assertTrue($sender->send("test_http", "message"));
    }

}
