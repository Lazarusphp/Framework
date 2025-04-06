<?php

namespace App;

use App\System\App;
use App\System\BootManager\Loader;
use App\System\Classes\Requests\Requests;
use App\System\Classes\VersionControl\VersionControl;
use App\System\Writers\SessionWriter;
use LazarusPhp\LazarusDb\QueryBuilder;
use LazarusPhp\SessionManager\Sessions;
use LazarusPhp\SessionManager\SessionsFactory;

class Boot extends Loader
{

    public static function run()
    {
        // Load class arrays must be in order
        require_once("../App/functions.php");
        iniControl();
       self::classLoader("generateRoot","setEnv","loadConnection","loadRouter");
        // Code to run the application
    }
}