<?php
ob_start();

use LazarusPhp\Exceptions\Exceptions\FileNotFoundException;
use LazarusPhp\Foundation\PathResolver\Resolve;

require_once(__DIR__ . "/../App/App.php");
require_once(__DIR__ . "/../vendor/autoload.php");
// Autoload Dispatcher as Global
Resolve::init(__DIR__, 1);



if (!class_exists('App\Boot')) {
    throw new FileNotFoundException("Boot Class does not Exist");
}

try {
    loadFile(Resolve::get("Root") . "/Bootloader/Providers.php");
} catch (FileNotFoundException $e) {
    echo "Bootloader/Providers.php file not found";
    exit;
}
ob_flush();
