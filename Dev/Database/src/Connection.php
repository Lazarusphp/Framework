<?php
namespace LazarusPhp\Database;

abstract class Connection
{
    private static array $config = [];
    
    public static function make(?string $type=null,?string $hostname=null,?string $username=null,?string $password=null,?string $dbname=null):void
    {
          self::$config = 
        [
            "type"=>($type ?? $_ENV["type"]),
            "hostname"=>($hostname ?? $_ENV["hostname"]),
            "username"=>($username ?? $_ENV["username"]),
            "password"=>($password ?? $_ENV["password"]),
            "dbname"=>($dbname ?? $_ENV["dbname"]),
        ];
    }

    public static function retrieve():array
    {
        return self::$config;
    }
}