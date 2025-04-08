<?php

namespace App\System\Classes\ClassInjector;

class Injector
{
    private static $classname;
    private static $method;
    private static $args;
    private $required = false;
    private $requireClasses = [];
    private $missingClasses = [];
    // Class implementation goes here#

    public static function inject(string $class, string $method, ...$args)
    {
        self::$classname = $class;
        self::$method = $method;
        self::$args = $args;
        return new self();
    }

    public function requires(...$classes)
    {
        foreach ($classes as $class) {
            if (!class_exists($class)) {
                $this->missingClasses[] = "Cannot locate Class $class"; 
            }
        }

        if(count($this->missingClasses) >= 1)
        {
            $this->required = true;
        }
        else
        {
            $this->required = false;
        }
        return $this;
    }

    public function load()
    {
        if (!$this->required) {
            if (class_exists(self::$classname)) {
                if (method_exists(self::$classname, self::$method)) {
                    return call_user_func_array([self::$classname, self::$method], self::$args);
                }
            }
        }
        else
        {
            foreach($this->missingClasses as $message)
            {
                trigger_error($message);
            }
        }
    }
}
