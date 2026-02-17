<?php
ob_start();
use App\Boot;
use LazarusPhp\Exceptions\Dispatcher;
use LazarusPhp\Exceptions\Exceptions\FileNotFoundException;
use LazarusPhp\Foundation\PathResolver\Resolve;

require(__DIR__ . "/../vendor/autoload.php");
// Autoload Dispatcher as Global
Resolve::init(__DIR__,1);
if(!class_exists(Dispatcher::class))
{
    throw new LogicException("CLass Dispatcher Does Not Exist");
}

$dispatcher = new Dispatcher();
set_exception_handler([$dispatcher,'dispatch']);


if (!class_exists('App\Boot'))
{
    throw new FileNotFoundException("Boot Class does not Exist");
}

    new Boot($dispatcher);

ob_flush();
