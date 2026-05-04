<?php

use LazarusPhp\PathResolver\Resolver;
use LazarusPhp\ServiceProvider\Application;

// $compile = new Application(__DIR__);
// $compile->withPaths(dirname(__DIR__,1),[
// "cache"=>"Bootstrap/Cache",
// "cache.config"=>"Bootstrap/Cache/Config.php",
// "basepath"=>"/"
// ])->create();

$app = new Application(__DIR__)->boot();

// app("paths")->load("Router");

// new Boot();