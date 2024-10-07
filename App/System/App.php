<?php

namespace App\System;
use App\System\Classes\Structure\Structure;
use LazarusPhp\DateManager\Date;
use LazarusPhp\SessionManager\Sessions;
use App\System\Classes\ErrorHandler\Errors;
use LazarusPhp\DatabaseManager\CredentialsManager;

class App
{
    public $root;
    public $paths;
    public $path;
    public $config = "/Config.php";

    private $structure;

    public function __construct()
    {   $this->structure = new Structure();
        $this->structure->loadPaths();
        $this->boot();
        Errors::boot();
 
    }


    public function boot($name = null)
    {
        CredentialsManager::SetConfig(CONFIG.$this->config);
        $session = new Sessions();
        if (session_status() == PHP_SESSION_NONE) {
            $session->start();
        }
        include_once(FUNCTIONS);
        include_once(ROUTER);
        
    }
}
