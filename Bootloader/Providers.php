<?php

use App\Boot;
use App\Providers\DatabaseProvider;
use App\Providers\EnvProvider;
use App\Providers\MapProvider;
use App\Providers\SessionsProvider;
use LazarusPhp\Foundation\Providers\Providers;

$container = Providers::map([EnvProvider::class,MapProvider::class])->create();
new Boot($container);