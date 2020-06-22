<?php declare(strict_types=1);


namespace Test\Utils;

use Northarea\PhpAmqp\Utils\Validator;
use PHPUnit\Framework\TestCase;

/**
 * Class ValidatorTest
 * @package Test\Utils
 */
class ValidatorTest extends TestCase
{
    public function testEmail()
    {
        $validator = new Validator();
        $this->assertEquals("a.kozlov@nuzhnapomosh.ru", $validator->email("a.kozlov@nuzhnapomosh.ru"));
        $this->assertFalse($validator->email("a.kozlov@nuzhnapomosh"));
    }

    public function testInt()
    {
        $validator = new Validator();
        $this->assertEquals(7, $validator->integer(7));
        $this->assertFalse($validator->integer(7.7));
    }

    public function testUrl()
    {
        $validator = new Validator();
        $this->assertEquals("http://www.google.com", $validator->url("http://www.google.com"));
        $this->assertFalse($validator->url("www.google.com"));
    }
}

