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
use App\System\Classes\ClassInjector\Injector;
use LazarusPhp\LazarusDb\Connection;

class Boot extends Loader
{

    public function __construct()
    {
        require_once("../App/functions.php");

        iniControl();
        self::generateRoot();
        self::setEnv();
        self::loadConnection("");
        self::loadRouter();
        self::run();
    }

}