<?php

namespace App\System;
use App\System\Classes\Structure\Structure;
use App\System\Classes\ErrorHandler\Errors;
use App\System\Classes\Injection\Container;
use LazarusPhp\DatabaseManager\Connection;
use Dotenv\Dotenv;
use FireCore\FileWriter\Writer;
use FireCore\FileWriter\JsonWriter;
use App\Boot;
use App\System\Classes\VersionControl\VersionControl;
use App\System\Providers\BindProviders;

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
        BindProviders::bind();
        $this->setEnv();
        // Instantiate Connection;
        Connection::instantiate("env");
    }

    public function versionControl()
    { 
        return $this->versionControl;
    }
    

    public function loadRouter():void
    {  
        $folder = ROOT."/Storage";

        if (!is_writable($folder)) {
            throw new \RuntimeException('Storage directory is not writable: ' . $folder);
        }
        else
        {
            include_once(ROOT."/App/System/Router/router.php");
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

