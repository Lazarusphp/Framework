<?php
namespace App\Http\Model;
use LazarusPhp\QueryBuilder\Builder;
use ReflectionClass;

class Model extends Builder
{
    protected $allowed = [];
    protected $filtered = [];

    public static function __callStatic($method, $params)
    {
         $class = static::class;
         $class = new ReflectionClass($class)->getShortName();
         echo strtolower(str_replace(" ","_",$class));
    }

    public function hello()
    {
        echo "Hello";
    }
}