<?php

namespace App\System\Classes\ClassInjector;

class Injector
{
    private $classname;
    private $required = [];

    public function __construct(string $classname,callable $functions)
    {
        $this->classname = $classname;
        if(is_callable($functions))
        {
            $functions($this);
        }
        return $this;
    }

    public function requires(array $classes = [])
    {
        if(is_array($classes) && count($classes) >= 1)
        {
            foreach($classes as $class)
            {
                if(!class_exists($class))
                {
                    $this->required[] = "Class is Required $class";   
                }
            }
        }
        else
        {
            echo "This method cannot be used with no class parameters loaded";
        }
    }

    public function save()
    {
        if(count($this->required) >= 1)
        {
            foreach($this->required as $class)
            {
                echo $class;
            }
        }
        else
        {
            echo "We can Continue";
        }
    }

}