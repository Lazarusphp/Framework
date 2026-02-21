<?php

namespace App\System\Core;
use LazarusPhp\LazarusDb\Database\Connection;
use Dotenv\Dotenv;
use LazarusPhp\Foundation\PathResolver\Resolve;

class BootLoader
{
    protected static function loadConnection()
    {
       Connection::activate();
    }

    protected static function setEnv()
   {
        // Instantiate env root directory
        $env_path = Resolve::get("Root");
        // Check the file
        if(is_file($env_path."/.env"))
        {
            // Create Env File
            $env = Dotenv::createImmutable($env_path);
            // Load Env File
            $env->load();
            // Required and must not be empty
            $env->required(["type","hostname","username","dbname"])->notEmpty();
            // Required but can be left empty (not recommended for production servers)
            $env->required("password");
        }
   }


   public static function loadRouter():void
   {  
       $file = Resolve::get("Config")."/Router.php";
       if(is_readable($file) && file_exists($file)){
           include_once($file);
       }
       else
       {
           echo "file is not found or unreadable";
       }
  }

}