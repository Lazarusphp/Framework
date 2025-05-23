<?php

use App\Boot;
use LazarusPhp\AuthControl\Auth;
use LazarusPhp\AuthControl\CoreFiles\AuthCore;
use LazarusPhp\LazarusDb\QueryBuilder;
use LazarusPhp\SecurityFramework\Hash;

require(__DIR__ . "/../vendor/autoload.php");

if (class_exists('App\Boot'))
{
    new Boot();
}
else
{
    trigger_error("Boot class not found");
}
