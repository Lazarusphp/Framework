<?php

if(!function_exists("request"))
{
    function request()
    {
        // Add Request handler here;
        if(!app()->has("request"))
        {
            echo "No Helper Found";
        }

        return app("request");
    }
}
