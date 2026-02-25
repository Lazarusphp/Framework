<?php
namespace LazarusPhp\Database;

use LazarusPhp\Database\Connection;
use PDO;
use PDOException;
use PDOStatement;
use RuntimeException;

abstract class Database 
{

  

    protected ?PDOStatement $stmt = null;
    public int $lastId = 0;
    private array $config;
    private $connection;
    protected bool $isConnected = false;

    public function __construct()
    {
        $this->config = Connection::retrieve(); 
        $this->connect();
    }

    private function connect()
    {
        // Implement the connection Test here
        if(!$this->isConnected)
        {
            $this->connection = new PDO($this->dsn(),$this->config["username"],$this->config["password"], $this->options());
            $this->isConnected = true;
            echo "connected";
        }
    }


    private function getConnection()
    {
        if($this->isConnected === true)
        {
            return $this->connection;
        }
    }
    
 

    private function options():array
    {
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        return $options;
    }

        private function dsn():string
    {
        return $this->config["type"] . ":host=" . $this->config["hostname"] . ";dbname=" . $this->config["dbname"];
    }


    // Begin transaction
    protected function beginTransaction()
    {
        try {
            $this->getConnection()->beginTransaction();
        } catch (PDOException $e) {
            throw new RuntimeException("Failed to begin transaction: " . $e->getMessage(), (int)$e->getCode());
        }
    }
        // $this->getConnection()->beginTransaction();

    // Commit transactoin
    protected function commit()
    {
        try {
            $this->getConnection()->commit();
        } catch (PDOException $e) {
            throw new RuntimeException("Failed to commit transaction: " . $e->getMessage(), (int)$e->getCode());
        }
    }

    // RollBack a transaction if failed
    protected function rollback()
    {
        try {
            $this->getConnection()->rollback();
        } catch (PDOException $e) {
            throw new RuntimeException("Failed to rollback transaction: " . $e->getMessage(), (int)$e->getCode());
        }
    }

    // Set Prepare Statement using prepart
    protected function prepare(string $sql)
    {
        return $this->getConnection()->prepare($sql);
    }

    // Set prepare statements using query
    protected function query(string $sql)
    {
        return $this->getConnection()->query($sql);
    }
}