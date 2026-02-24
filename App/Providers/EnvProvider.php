<?php
namespace App\Providers;
use LazarusPhp\Foundation\Providers\Psr\Container;
use Dotenv\Dotenv;
use LazarusPhp\Foundation\Providers\Interfaces\ProviderInterface;
use LazarusPhp\Foundation\PathResolver\Resolve;

class EnvProvider implements ProviderInterface
{

    public function register(Container $c): void
    {
        $c->singleton("env",function () use ($c)
        {
             // Instantiate env root directory
        $c->get("mapper");
        $env_path = Resolve::get("Root");
        // Check the file
        if(is_file($env_path."/.env"))
        {
            // Create Env File
            $env = Dotenv::createImmutable($env_path);
            // Load Env File
            $env->load();
            // Required and must not be empty
            $env->required(["type","hostname","username","dbname"])->notEmpty();
            // Required but can be left empty (not recommended for production servers)
            $env->required("password");
        }
        }
        );


    }
}