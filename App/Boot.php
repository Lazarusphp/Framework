<?php

namespace App;

use App\System\Core\BootLoader;
use App\System\Core\Strings;
use LazarusPhp\Exceptions\Dispatcher;
use LazarusPhp\Exceptions\Listeners\DirectoryNotFoundListener;
use LazarusPhp\Exceptions\Listeners\FallbackExceptionListener;
use LazarusPhp\Exceptions\Listeners\FileNotFoundListener;
use LazarusPhp\Foundation\PathResolver\Resolve;
use LazarusPhp\Foundation\Validation\Rules;
use LazarusPhp\Foundation\Validation\StringRules;
use LazarusPhp\Logger\FileLogger;


class Boot extends BootLoader
{
    public function __construct(Dispatcher $dispatcher)
    {
        include_once(Resolve::get("Config")."/Functions.php");
        LoadIni();
        self::setEnv();
        $storage = Resolve::get("Storage");
        $logger = new FileLogger("{$storage}/Logs.txt");
        $dispatcher->add([
        new DirectoryNotFoundListener($logger),
        new FileNotFoundListener($logger),
        new FallbackExceptionListener($logger),
        ]);
    
            $rules = Rules::create(StringRules::class,["name"=>"test"]);

            $dispatcher->autoloadListeners();



        

   
            
    


     


        // Get Connection Status
        self::loadConnection();
        /**
         * load Session Instantiation before load Router
         * echoing anything before will get cause errors and warnings.
         */

        // $session = new Sessions();
        // $session->instantiate([SessionWriter::class], ["days" => 365, "httponly" => false, "secure" => false]);
        // SchemaLoader::load(__DIR__ . "/../Migrations/Schemas", "up", "profile");

        // $schema = new BridgeValidator("members");

      

    }
}
