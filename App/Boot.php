<?php

namespace App;

use App\System\App;
use App\System\BootManager\Loader;

class Boot extends Loader
{

    public function __construct()
    {
        require_once("../App/functions.php");

        iniControl();
        self::generateRoot();
        self::setEnv();
        self::loadConnection();
        self::loadRouter();
    }

}