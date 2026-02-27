<?php
namespace App\Providers;
use LazarusPhp\Foundation\Providers\Interfaces\ProviderInterface;
use LazarusPhp\Foundation\Providers\Psr\Container;
use LazarusPhp\SessionManager\Sessions;
use LazarusPhp\SessionManager\Writers\SessionWriter;

class SessionsProvider implements ProviderInterface
{

    public function register(Container $c):void
    {
        $c->singleton("sessions",function() use ($c)
        {
            
            $c->get("db");
            return Sessions::create()->withConfig(["table"=>"sessions","days"=>8])->save();
        });
    }
}