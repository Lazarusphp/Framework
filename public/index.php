<?php

use App\Boot;


require(__DIR__ . "/../vendor/autoload.php");
if (class_exists('App\Boot'))
{
    new Boot();
}
else
{
    trigger_error("Boot class not found");
}