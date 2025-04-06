<?php

namespace App\System;
use App\System\Classes\Structure\Structure;
use App\System\Classes\ErrorHandler\Errors;
use App\System\Classes\Injection\Container;
use LazarusPhp\LazarusDb\Connection;
use Dotenv\Dotenv;
use App\Boot;
class App  extends Structure
{  
    private $structure;
    private $versionControl = false;
    public function __construct($versionControl=false)
      {   
        require_once("../App/functions.php");
        iniControl();
        $versionControl == false ? $this->versionControl = false : $this->versionControl = true;
        self::generateRoot();
        $this->setEnv();
        // Instantiate Connection;
    }

    public function versionControl()
    { 
        return $this->versionControl;
    }


    public function loadDatabase(string $file="")
    {
        if(!empty($file))
        {
            Connection::file($file);
        }
        Connection::activate();
    }
    

    public function loadRouter():void
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

   private function setEnv()
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
}

