<?php

namespace App;

use App\Http\Model\Users;
use App\System\App;
use App\System\BootManager\Loader;
use LazarusPhp\LazarusDb\Database\Connection;
use LazarusPhp\LazarusDb\QueryBuilder\QueryBuilder;
use LazarusPhp\LazarusDb\SchemaBuilder\Schema;
use LazarusPhp\SessionManager\Sessions;
use LazarusPhp\SessionManager\Writers\SessionWriter;
use LazarusPhp\LazarusDb\SchemaBuilder\SchemaLoader;
use LazarusPhp\LazarusDb\SchemaBuilder\Table;

class Boot extends Loader
{

    public function __construct()
    {
        require_once("../App/functions.php");

        iniControl();
        self::generateRoot();
        self::setEnv();
        // Get Connection Status
        self::loadConnection();
        /**
         * load Session Instantiation before load Router
         * echoing anything before will get cause errors and warnings.
         */

        $session = new Sessions();
        $session->instantiate([SessionWriter::class],["days"=>365,"httponly"=>false,"secure"=>false]);
    
    }
}