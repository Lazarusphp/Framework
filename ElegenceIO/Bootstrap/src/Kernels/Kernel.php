<?php
namespace ElegenceIO\Bootstrap\Kernels;

use ElegenceIO\Bootstrap\Processing\Binding;
use ElegenceIO\Bootstrap\Processing\Configurator;
use ElegenceIO\Bootstrap\Processing\Registration;
use ElegenceIO\Containers\ContainerRegistry;
use ElegenceIO\Containers\Container;
use ElegenceIO\Http\Kernel\Kernel as Http;
use ElegenceIO\Console\Requests\Kernel as Console;
use ElegenceIO\Contracts\Bootstrap\BootstrapKernel;
use ElegenceIO\Support\Structure\Files;
use ElegenceIO\Support\Types\Arrays;
use Exception;

class Kernel
{
    private ?Binding $binding = null;
    private ?Registration $register = null;

    private ?Container $container = null;
    public function __construct(private array $data)
    {
        $this->data = $data;
        $this->startContainer();
        $this->binding = new Binding($this->container,$this->data);
        $this->register = new Registration($this->container,$this->data);
    }

    /**
     * private @method startContainer
     * @return void
     *
     */

    private function startContainer():void
    {
        $this->container = new Container();
        ContainerRegistry::set($this->container);
    }

    /**
     * private @method RegisterHelpers()
     * @return void
     */

    /**
     * private @method loadRouters
     */
    private function loadRouters():void
    {
        $router = $this->data["router"];
        // Valiate Routing and load
        if(!empty($router))
        {
            foreach($router as $route)
            {
                if(Files::has($route))
                {
                    require_once $route;
                }
            }
        }

        unset($router);
    }
    
    /**
     * Prebootstrap Setup
     * @method preBootstrap()
     *  @includes start containers basepath
     * 
     */

    private function preBootstrap()
    {
        $this->register->helpers();
        $this->register->basepath();
        $this->register->paths();
        $this->register->configurator();
    }

    


    private function postBootstrap()
    {
        $this->container->make("configurator")->create();
        $this->register->providers();
        $this->loadRouters();

    }

    public function handle(mixed $requests):object
    {
        // this strtd the containeers and sets the baspath
        $this->preBootstrap();
        $this->postBootstrap();
        $configs = $this->container->make("configurator");

        $handle = (\php_sapi_name() !== "cli") ? new Http($this->container,$configs,$requests) : new Console($this->container,$configs,$requests);
        
        if(!$handle instanceof BootstrapKernel)
        {
            throw new Exception("Failed to load Boostrapper");
        }

        return $handle->boot();
    }
}