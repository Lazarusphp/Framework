<?php
namespace ElegenceIO\Bootstrap\Processing;

use DirectoryIterator;
use ElegenceIO\Containers\Container;
use ElegenceIO\Contracts\Bootstrap\Configurator as BootstrapConfigurator;
use ElegenceIO\Support\Structure\Directories;
use ElegenceIO\Support\Types\Arrays;
use ElegenceIO\Support\Structure\Files;
use Exception;

class Configurator
{
      /**
     * plan of action v1.0.0
     * 
     * load containers into the contstructor
     * set the basepath
     * Load  Required Files.
     * register Containers
     */

    private array $paths = [];
    private array $configs = [];
    private ?Binding $binding = null;

    public function __construct(private ?Container $container,private array $data)
    {
        $this->container = $container;
        $this->data = $data;
        $this->binding = new Binding($this->container,$this->data);
    }

    /**
     * EagerLoading Containers.
     * public @method withContainers();
     * @return string
     */
    
    public function withContainers(array $keys)
    {
            $bindings = [
                "shared"=>$this->binding->shared(),
                "cli"=> $this->binding->cli(),
                "http"=>$this->binding->http(),
            ];

            foreach($keys as $key)
            {
                if(Arrays::in($key,array_keys($bindings)))
                
                    return $bindings[$key];
            
            }
            
    }
    

    public function create()
    {
         // Config cache Locations
        $this->paths = [
            "cache"=> $this->data["basepath"] ."/Bootstrap/Cache/Config.php",
            "configs" => $this->data["basepath"]."/Configs"
        ];

        (Files::has($this->paths["cache"])) ?  $this->loadCached() : $this->loadConfigs();
            foreach($this->configs as $name => $config)
        {
                $this->container->bind("config.$name",$config);
        }  
    }

    /**
     * Detect Individual CachedConfig FIle.
     */
    private function loadCached()
     {
        if(!Directories::has(dirname($this->paths["cache"])))
        {
            throw new Exception("Cache Directory Cannot be found");
        }

        $config = require_once $this->paths["cache"];

        foreach($config as $name => $value)
        {
            $name = strtolower($name);
            $this->configs[$name] = $value;
        }
     }

     /**
      *  Detect Config Directory.
      */
     private function loadConfigs()
     {
        foreach(new DirectoryIterator($this->paths["configs"]) as $item)
        {
            if($item->isDot())continue;
            $info =  $item->getFileInfo();
            $filename = $item->getFilename();
            if($filename === ".php") continue;
            [$name,$key] = explode(".",$filename,3);
            $name = strtolower($name);
            $this->configs[$name] = require_once $info;
           }
     }

     


}
