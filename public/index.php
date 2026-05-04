<?php
ob_start();

use LazarusPhp\Exceptions\Exceptions\FileNotFoundException;
use LazarusPhp\PathResolver\Resolve;
use App\Boot;
use LazarusPhp\Core\Containers\ContainerFactory;

require_once(__DIR__ . "/../vendor/autoload.php");
// Autoload Dispatcher as Global
// Resolve::init(__DIR__, 1);
include dirname(__DIR__,1)."/Bootstrap/App.php";
ob_flush();
