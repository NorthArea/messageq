<?php


namespace Northarea\Contracts\Core;


use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

interface AmqpInterface
{
    public function getConnection(): AMQPStreamConnection;

    public function getChannel(): AMQPChannel;
}
