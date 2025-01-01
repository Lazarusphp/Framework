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

class App
{
    public $root;
    public $paths;
    public $path;
    public $config = "/Config2.php";
    private $structure;

    public function __construct()
      {   
        ini_set("display_errors",1);
        ini_set("display_startup_errors",1);
        error_reporting(E_ALL);
        $this->structure = new Structure();
        $this->structure->loadPaths();
        $this->boot();
    }

    public function loadRouter():void
    {  
        $folder = ROOT."/Storage";
        if($this->structure->hasDirectory($folder) === true)
        {
            if(!chmod($folder,0777))
            {
                trigger_error("Storage Directory is not writable ");
            }
            else
            { 
                include_once(ROUTER);
            }
       }
        else
        {
            trigger_error("Storage Directory is missing Please Create it");
        }
        
    }

    public function boot()  :void
    {
            DbConfig::load(CONFIG.$this->config,[PhpWriter::class]);
            include_once(FUNCTIONS);     
    }
}

