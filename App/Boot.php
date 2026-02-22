<?php

namespace App;

use App\System\Core\BootLoader;
use App\System\Core\Strings;
use InvalidArgumentException;
use LazarusPhp\Exceptions\Dispatcher;
use LazarusPhp\Exceptions\Listeners\DirectoryNotFoundListener;
use LazarusPhp\Exceptions\Listeners\FallbackExceptionListener;
use LazarusPhp\Exceptions\Listeners\FileNotFoundListener;
use LazarusPhp\Foundation\Application\Container;
use LazarusPhp\Foundation\PathResolver\Resolve;
use LazarusPhp\Foundation\Validation\ArrayRules;
use LazarusPhp\Foundation\Validation\FormRules;
use LazarusPhp\Foundation\Validation\IntRules;
use LazarusPhp\Foundation\Validation\Rules;
use LazarusPhp\Foundation\Validation\StringRules;
use LazarusPhp\Logger\FileLogger;
use LogicException;

class Boot
{
    public function __construct(Dispatcher $dispatcher)
    {
        include_once(Resolve::get("Config") . "/Functions.php");
        // self::setEnv();
        $storage = Resolve::get("Storage");
        $logger = new FileLogger("{$storage}/Logs.txt");
        $dispatcher->add([
            new DirectoryNotFoundListener($logger),
            new FileNotFoundListener($logger),
            new FallbackExceptionListener($logger),
        ]);

        include_once(Resolve::get("Root")."/Bootloader/Providers.php");
        $dispatcher->autoloadListeners();









        // Get Connection Status
        // self::loadConnection();
        /**
         * load Session Instantiation before load Router
         * echoing anything before will get cause errors and warnings.
         */

        // $session = new Sessions();
        // $session->instantiate([SessionWriter::class], ["days" => 365, "httponly" => false, "secure" => false]);
        // SchemaLoader::load(__DIR__ . "/../Migrations/Schemas", "up", "profile");

        // $schema = new BridgeValidator("members");



    }

    protected function exceptions()
    {
        // Exception Handler and Listerner Will go here;

        $dispatcher->autoloadListerers();
    }


    protected function Logger()
    {

    }

    // Boot Will be the last thing to Load
    public function boot(Container $container)
    {
    }



}
