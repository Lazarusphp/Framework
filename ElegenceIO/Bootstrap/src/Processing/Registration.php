<?php
namespace ElegenceIO\Bootstrap\Processing;
use ElegenceIO\Containers\Container;
use ElegenceIO\Foundation\Requests\Psr\PsrKernel;
use ElegenceIO\Support\Helpers\Helpers;
use ElegenceIO\Support\Types\Arrays;

class Registration
{
    public function __construct(private ?Container $container,private array &$data)
    {
        $this->container = $container;  
        $this->data = $data; 
        $this->data["bootstrapped"] = true;
    }


        
    /**
     * private @method basepath() 
     * designed to register and set the Basepath.
     * @return void
     * 
     */
    public function basepath()
    {
        $this->container->bind("basepath",$this->data["basepath"]);
    }

    /**
     * public @method providers
     * @return void
     * unset @property $providers;
     */

    public function providers():void
    {
        $providers = $this->data["providers"];
        if(Arrays::exists("providers",$this->data))
        {
            $provider = new Providers($providers);
            $provider->process($this->container);
        }
        unset($providers);
    }
        
    /**
     * private @method paths() 
     * used to register predefined paths;
     * @return void
     * 
     */
    public function paths():void
    {
        $paths =[
            "storage"=> "Storage",
            "storage.cache" =>  "Storage/Cache",
            "configs"=>"Configs",
            "configs.cache"=>"/Boostrap/Cache/Configs.php"
        ]; 

        foreach($paths as $key => $path)
        {
            $fullpath = $this->data["basepath"]."/$path";
            $this->container->bind("paths.$key",$fullpath);
        }
    }


    /**
     * public @method configurator();
     * @return object;
     */
    public function configurator()
    {
        $configurator = new Configurator($this->container,$this->data);
        return $this->container->bind("configurator",$configurator);
    }
        
    /**
     * private @method helpers() 
     * Helpers method designed to load prefined Helpers functions.
     * once loaded functions app() and basepath() become available.
     * @return void
     * 
     */
    public function helpers()
    {  
        $files = __DIR__."/../../Files/Helpers";        
        
        $helpers = $this->container->make(Helpers::class); 
        $helpers->add($files);
        $helpers->reload();
    }
}