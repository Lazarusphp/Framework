<?php
namespace ElegenceIO\Bootstrap\Processing;

use ElegenceIO\Containers\Container;
use ElegenceIO\Contracts\Containers\ServiceProviders;
use Exception;

class Providers
{
    public function __construct(private array &$data)
    {
        $this->data = $data;
    }

    public function process(?Container $container)
    {
        $providers = [];
         foreach($this->data as $providerClass)
        {
            // Check if the class Exists or doesnt 
            if(!class_exists($providerClass))
            {
                throw new Exception("Class {$providerClass} Cannot be loaded");
            }

            $provider = new $providerClass();

            if(!$provider instanceof ServiceProviders)
            {
                throw new Exception("{$providerClass} is not an instance of Service Provider interface");
            }

            if(!empty($provider->dependsOn()))
            {
                foreach($provider->dependsOn() as $dependency)
                {
                    if(!\class_exists($dependency))
                    {
                        throw new Exception("Provide Dependency class does not exist");
                    }
                }
            }
        
            $providers[] = $provider;
            $provider->register($container);
        }

            foreach($providers as $provider)
            {
                $provider->boot($container);
            }
            
    }


}