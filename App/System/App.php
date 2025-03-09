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

class App  extends Structure
{  
    private $structure;
    private $versionControl = false;

    public function __construct($versionControl=false)
      {   
       ini_set("display_errors",1);
        ini_set("display_startup_errors",1);
        error_reporting(E_ALL);
        if($versionControl == false)
        {
            $this->versionControl = false;
        }
        else
        {
            $this->versionControl = true;
        }
        self::generateRoot();
        
        // AutoLoad the Path before Calling the file.
        // self::mapPath(ROOT."/Storage/Paths.ini","Paths");
        Writer::bind("Versions",ROOT."/Storage/Versions.json",[JsonWriter::class]);
        $this->boot();
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

    public function boot()  :void
    {
        // Instantiate Env file
        $env_path = ROOT;
        Boot::loadVc();
        if(is_file($env_path."/.env"))
        {
            $env = Dotenv::createImmutable($env_path);
            $env->load();
            $env->required(["type","hostname","username","dbname"])->notEmpty();
            $env->required("password");
        }

        //TODO Move Instantiation class somewhere else
        Connection::instantiate("env");
        include_once(ROOT."/App/functions.php");
        }
}

