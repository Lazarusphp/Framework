<?php

use App\Http\Controllers\HomeController;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use Laminas\Diactoros\Response\HtmlResponse;

$router = Router::create();
// Output the Default page
$router->get('/?',[HomeController::class,"index"],"home");
$router->get('/login',[HomeController::class,"login"],"login");

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // It's 404!
    $router->getPublisher()->publish(new HtmlResponse('Not found.', 404));
} catch (Throwable $e) {
    // Log and report...
    var_dump($e);
    echo json_encode($e,JSON_PRETTY_PRINT);
    $router->getPublisher()->publish(new HtmlResponse('Internal error.', 500));
}

