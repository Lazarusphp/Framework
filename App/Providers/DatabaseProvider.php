<?php
namespace App\Providers;

use LazarusPhp\Foundation\Application\Interfaces\ProviderInterface;
use LazarusPhp\Foundation\Application\Container;
use LazarusPhp\LazarusDb\Database\Connection;

class DatabaseProvider implements ProviderInterface
{
    public function register(Container $c): void
    {
        $c->singleton("db",function () use ($c)
        {
            echo "Creating Database Connection\n";
        }
        );

    }
}