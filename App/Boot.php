<?php

namespace App;

use App\Http\Model\Users;
use App\System\App;
use App\System\Core\BootLoader;
use App\System\Core\Functions;
use LazarusPhp\LazarusDb\Database\Connection;
use LazarusPhp\LazarusDb\QueryBuilder\QueryBuilder;
use LazarusPhp\LazarusDb\SchemaBuilder\Schema;
use LazarusPhp\SessionManager\Sessions;
use LazarusPhp\SessionManager\Writers\SessionWriter;
use LazarusPhp\LazarusDb\SchemaBuilder\SchemaLoader;
use LazarusPhp\LazarusDb\SchemaBuilder\Table;

class Boot extends BootLoader
{

    public function __construct()
    {
        $functions = new Functions();

        $functions->iniControl();
        self::generateRoot();
        self::setEnv();
        // Get Connection Status
        self::loadConnection();
        /**
         * load Session Instantiation before load Router
         * echoing anything before will get cause errors and warnings.
         */

        // $session = new Sessions();
        // $session->instantiate([SessionWriter::class],["days"=>365,"httponly"=>false,"secure"=>false]);
    

        SchemaLoader::load(__DIR__."/../Migrations/Schemas");
    }
}