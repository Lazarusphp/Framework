<?php
namespace App\System\Classes\Injection;

class Container
{

    private $class;
    private $method;

    public function __construct(array $class)
    {
        $this->generateClass($class);
    }


    private function generateClass(array $class):void
    {
        if(!is_array($class))
        {
            trigger_error("Class Must be an Array");
        }
        else
        {
            if(class_exists($class[0]))
            {
                $this->class = new $class[0]();
            }
        }
    }

    private function generateMethod(string $method):void
    {
        if(!is_string($method))
        {
            trigger_error("Method must be a string");
        }
        else
        {
            if(method_exists($this->class,$method))
            {
                $this->method = $method;
            }
        }
    }


    public function method(string $method,...$args)
    {
        $this->generateMethod($method);
        if($this->class && $this->method)
        {
            call_user_func_array([$this->class,$this->method],$args);
        }
        else
        {
            return null;
        }
    }

    public function getClass()
    {
        if($this->getClass)
        {
            return $this->getClass;
        }
    }

}