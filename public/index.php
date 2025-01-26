<?php
require(__DIR__ . "/../vendor/autoload.php");
use App\System\App;
use LazarusPhp\SessionManager\Sessions;

$app = new App();

$app->loadouter();
