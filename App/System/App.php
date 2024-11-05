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
    public $config = "/Config.php";
    private $structure;
    private $hashandler;
    private $sessions;

    public function __construct()
      {   
        ini_set("display_errors",1);
        ini_set("display_startup_errors",1);
        error_reporting(E_ALL);

        $this->structure = new Structure();
        $this->structure->loadPaths();
        $this->boot();
    }

    public function loadRouter()
    {
        include_once(ROUTER);
    }

    public function boot()
    {

        DbConfig::load(CONFIG.$this->config,[PhpWriter::class]);
        (new Container([Sessions::class]))->method("instantiate");
        include_once(FUNCTIONS);
     
    }
}
