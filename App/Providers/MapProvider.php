<?php
namespace App\Providers;

use LazarusPhp\Foundation\Providers\Interfaces\ProviderInterface;
use LazarusPhp\Foundation\Providers\Psr\Container;
use LazarusPhp\Foundation\PathResolver\Resolve;
class MapProvider implements ProviderInterface
{
    public function register(Container $c):void
    {
        $c->singleton("mapper",function() use ($c){
            Resolve::init(__DIR__,2);
            
            // Create Aditional Folders;
            Resolve::add("Assets","Assets");
        });

        
    }
}