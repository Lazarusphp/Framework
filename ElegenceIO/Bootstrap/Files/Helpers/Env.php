<?php
use ElegenceIO\Foundation\Parsers\Env;

if(!class_exists(Env::class))
{
    throw new Exception("Cannot Launch Env Helper");
}

if(!function_exists("env"))
{
    function env(string $key,?string $default=null)
    {
        if(!app()->has("env"))
        {
            throw new Exception("Env Container could not be found");
        }

        return app("env")->renderEnvVariable($key,$default);
    }
}