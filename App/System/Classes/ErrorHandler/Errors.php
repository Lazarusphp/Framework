<?php
namespace App\System\Classes\ErrorHandler;
class Errors extends ErrorControl
{


    private static $instance;
    public static function boot()
    {
        // Start Error Handler
        set_error_handler([__CLASS__, 'handleError']);
        if(!isset(static::$instance))
        {
            $c = get_called_class();
            static::$instance = $c;
        }

        self::$displayErrors = false;
        self::$useDbLog = false;

        return static::$instance;
    }
    
    public function __destruct()
    {
        
        restore_error_handler();
    }
    public static function hasErrors()
    {
        // Has Error Counts the Errors Lists;
        return self::countErrors() > 0 ? true : false;
    }

    public static function countErrors()
    {
        return count(self::$error);
    }
}