<?php
use ElegenceIO\FileSystem\Cache\Cache;

if(!class_exists(Cache::class))
{
    throw new Exception("Cannot Launch Env Helper");
}

if(!function_exists("cache"))
{
    function cache(string $file,?array $data=null)
    {
        if(!app()->has("cache"))
        {
            throw new Exception("Cannot Find container cache");
        }
        $app = app("cache");
        return ($data===null) ? $app->getFile($file) : $app->getFile($file)->write($data);
    }
}