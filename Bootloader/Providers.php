<?php

use App\Boot;
use App\Providers\DatabaseProvider;
use LazarusPhp\Foundation\Application\Container;
use LazarusPhp\Foundation\Application\Providers;
use LazarusPhp\LazarusDb\Database\CoreFiles\Database;
use LazarusPhp\SessionManager\Sessions;


$container = Providers::map([DatabaseProvider::class])->create();
return new Boot($container);