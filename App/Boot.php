<?php

namespace App;

use LazarusPhp\Exceptions\Dispatcher;
use LazarusPhp\Exceptions\Listeners\DirectoryNotFoundListener;
use LazarusPhp\Exceptions\Listeners\FallbackExceptionListener;
use LazarusPhp\Exceptions\Listeners\FileNotFoundListener;
use LazarusPhp\Foundation\Providers\Psr\Container;
use LazarusPhp\Foundation\PathResolver\Resolve;
use LazarusPhp\Logger\FileLogger;
use LogicException;

class Boot
{

    private FileLogger $logger;
    private Container $container;
    public function __construct(Container $container)
    {
        // Include Mandatory Files.

        include_once(__DIR__."/../Config/Functions.php");


        $this->container = $container;
        $this->exceptions();
        $this->boot();

    }

    protected function exceptions()
    {   
        // Instantiate The Logger File.


        $this->logger();
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
    public function boot()
    {
        echo $this->container->get("env");;
    }



}
