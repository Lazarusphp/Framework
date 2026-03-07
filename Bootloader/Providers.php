<?php

use App\Boot;
use App\Providers\DatabaseProvider;
use App\Providers\EnvProvider;
use App\Providers\MapProvider;
use App\Providers\SessionsProvider;
use App\Providers\HttpKernelProvider;
use LazarusPhp\Foundation\Providers\Providers;

$container = Providers::map([EnvProvider::class,
DatabaseProvider::class,
SessionsProvider::class,
HttpKernelProvider::class,
MapProvider::class])->create();
new Boot($container);