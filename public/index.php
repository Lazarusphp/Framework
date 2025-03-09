<?php

use App\Boot;


require(__DIR__ . "/../vendor/autoload.php");
if (class_exists('App\Boot'))
{
    Boot::run();
}
else
{
    trigger_error("Boot class not found");
}