<?php

namespace App\System;
use App\System\Classes\Structure\Structure;
use App\System\Classes\ErrorHandler\Errors;
use App\System\Classes\Injection\Container;
use App\System\Classes\PhpWriter as ClassesPhpWriter;
use LazarusPhp\DatabaseManager\ConfigLoader;
use LazarusPhp\DatabaseManager\ConfigWriters\PhpWriter;
use LazarusPhp\DatabaseManager\DbConfig;
use LazarusPhp\SessionManager\Sessions;
use MiladRahimi\PhpRouter\Routing\Route;

class App  extends Structure
{    public $config = "/Config2.php";
   
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
    //     $folder = ROOT."/Storage";
    //     if(self::hasDirectory($folder) === true)
    //     {
    //         if(!chmod($folder,0777))
    //         {
    //             trigger_error("Storage Directory is not writable ");
    //         }
    //         else
    //         { 
    //             // echo self::fetch("Paths","Router");
    //             include_once(self::fetch("Paths","Router"));
    //         }
    //    }
    //     else
    //     {
    //         trigger_error("Storage Directory is missing Please Create it");
    //     }
        
    }

    public function boot()  :void
    {
    //         DbConfig::load(self::fetch("Paths","Config").$this->config,[PhpWriter::class]);
    //         // self::loadStructure();
    //         include_once(self::fetch("Paths","Functions"));
    }
}

