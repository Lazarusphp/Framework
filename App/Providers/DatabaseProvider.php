<?php
namespace App\Providers;

use LazarusPhp\Database\Connection;
use LazarusPhp\Database\Database;
use LazarusPhp\Foundation\Providers\Interfaces\ProviderInterface;
use LazarusPhp\Foundation\Providers\Psr\Container;


class DatabaseProvider implements ProviderInterface
{
        public function register(Container $c): void
        {
            
            $c->singleton("db",function($c)
            {
                $c->get("env");
                Connection::make();
            });
        }
}