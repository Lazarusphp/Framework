<?php

if(!function_exists("logs"))
{
    function logs(mixed $error,string|Stringable $message,array $context=[])
    {
        if(app()->has("logs"))
        {
            return app("logs")->log($error,$message,$context);
        }
        // Add Request handler here;
    }
}