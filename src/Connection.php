<?php namespace MQ;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Connection {
    private $host;
    private $port;
    private $login;
    private $pwd;
    
    private $connection;

    /**
     * Constructor
     *
     * @param string $host
     * @param integer $port
     * @param string $login
     * @param string $pwd
     */
    public function __construct(string $host, int $port, string $login, string $pwd) {
        $this->host = $host;
        $this->port = $port;
        $this->login = $login;
        $this->pwd = $pwd;
    }

    /**
     * Connection
     *
     * @return AMQPStreamConnection
     */
    public function connect() :AMQPStreamConnection {
        $this->connect = new AMQPStreamConnection($this->host, $this->port, $this->login, $this->pwd);
        return $this->connect;
    }

}