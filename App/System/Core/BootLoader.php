<?php

namespace App\System\Core;
use LazarusPhp\LazarusDb\Database\Connection;
use Dotenv\Dotenv;

class BootLoader
{
    // Class implementation goes here
    
    private static $root;

    protected static function loadConnection(string $file="")
    {
        // (!empty($file)) ? Connection::file($file) : false;
        Connection::activate();
       
    }

    protected static function generateRoot():void
    {

        $allowedDir = ["public_html", "public", "www"];

        foreach ($allowedDir as $dir) {
            if (is_dir("../$dir")) {
                $explode = explode(DIRECTORY_SEPARATOR, getcwd());
                array_pop($explode);
                self::$root = implode(DIRECTORY_SEPARATOR, array: $explode);
            }
        }

        // Generate the Root Container;
        define("ROOT", self::$root);
    }

    protected static function setEnv()
   {
        // Instantiate env root directory
        $env_path = ROOT;
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