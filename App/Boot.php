<?php

namespace App;

use App\System\Core\BootLoader;
use App\System\Core\Strings;
use Faker\Provider\File;
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

    private FileLogger $logger;
    private Container $container;
    public function __construct(Container $container)
    {

        $this->container = $container;
        include_once(Resolve::get("Config") . "/Functions.php");
       

        $this->logger();
        $this->exceptions();
        $this->boot();


    }

    protected function exceptions()
    {
    
        // Exception Handler and Listerner Will go here;
        if(!class_exists(Dispatcher::class))
        {
            throw new LogicException("CLass Dispatcher Does Not Exist");
        }

        $dispatcher = new Dispatcher();
        set_exception_handler([$dispatcher,'dispatch']);

         $dispatcher->add([
            new DirectoryNotFoundListener($this->logger),
            new FileNotFoundListener($this->logger),
            new FallbackExceptionListener($this->logger),
        ]);

        $dispatcher->autoloadListeners();
    }


    protected function Logger()
    {
        $this->logger = new FileLogger(Resolve::get("Storage")."/Logs.txt");
    }

    // Boot Will be the last thing to Load
    public function boot(?Container $container=null)
    {
        echo $this->container->get("db");
    }



}
