<?php

namespace App\System;
use App\System\Classes\Structure\Structure;
use App\System\Classes\ErrorHandler\Errors;
use App\System\Classes\Injection\Container;
use LazarusPhp\DatabaseManager\ConfigLoader;
use Dotenv\Dotenv;
use LazarusPhp\DatabaseManager\ConfigWriters\PhpWriter;
use LazarusPhp\DatabaseManager\Connection;
use LazarusPhp\SessionManager\Sessions;
use MiladRahimi\PhpRouter\Routing\Route;

class App  extends Structure
{    public $config = "/Config.php";
   
    private $structure;

    public function __construct()
      {   
        ini_set("display_errors",1);
        ini_set("display_startup_errors",1);
        error_reporting(E_ALL);
        self::generateRoot();
        
        // AutoLoad the Path before Calling the file.
        // self::mapPath(ROOT."/Storage/Paths.ini","Paths");
        $this->boot();
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
        if(is_file($env_path."/.env"))
        {
            $env = Dotenv::createImmutable($env_path);
            $env->load();
            $env->required(["type","hostname","username","dbname"])->notEmpty();
            $env->required("password");
        }
        include_once(ROOT."/App/functions.php");
        }
}

