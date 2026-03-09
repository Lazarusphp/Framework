<?php
namespace App\Http\Model;

use Exception;
use LazarusPhp\QueryBuilder\QueryBuilder;
use ReflectionClass;

class Model
{
    protected array $attributes = [];
    protected array $fillable = [];
    protected array $guarded = [];

    // Magic setter stores values for the builder
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    // Magic getter
    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function builder($table):QueryBuilder
    {
        $builder = new QueryBuilder($table);
                if (!empty($this->fillable)) {
            $builder->fillable($this->fillable);
        }
        if (!empty($this->guarded)) {
            $builder->guarded($this->guarded);
        }
        return $builder;
    }

 
     public static function __callStatic($method, $params)
    {
        $instance = new static();
        return $instance->__call($method, $params);
    }

    public function __call($method, $params)
    {
        $table = strtolower((new ReflectionClass($this))->getShortName());
        $builder = $this->builder($table);
        if(!empty($this->attributes)){
         // If CRUD operation, pass stored attributes automatically
            if (in_array($method, ['insert', 'update'])) {
                array_unshift($params, $this->attributes);
            }
        }
        return $builder->$method(...$params);
    }

}