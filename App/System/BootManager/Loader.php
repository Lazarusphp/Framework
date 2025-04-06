<?php

namespace App\System\BootManager;

use App\System\Classes\Structure\Structure;
use LazarusPhp\LazarusDb\Connection;
use Dotenv\Dotenv;

class Loader extends Structure
{
    // Class implementation goes here


    public static function classLoader(...$classes)
    {
        if(count($classes) >= 1)
        {
            foreach($classes as $class)
            {
                self::$class();
            }
        }
    }

    protected static function loadConnection(string $file="")
    {
        (!empty($file)) ? Connection::file($file) : false;
        Connection::activate();
    }

    protected static function setEnv()
   {
        // Instantiate Env file
        $env_path = ROOT;
        if(is_file($env_path."/.env"))
        {
            $env = Dotenv::createImmutable($env_path);
            $env->load();
            $env->required(["type","hostname","username","dbname"])->notEmpty();
            $env->required("password");
        }
   }

   public static function loadRouter():void
   {  
       $file = ROOT."/App/System/Router/router.php";
       if(is_readable($file) && file_exists($file)){
           include_once($file);
       }
       else
       {
           echo "file is not found or unreadable";
       }
  }

}