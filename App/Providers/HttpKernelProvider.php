<?php
namespace App\Providers;

use LazarusPhp\Foundation\Providers\Interfaces\ProviderInterface;
use LazarusPhp\Foundation\Providers\Psr\Container;
use LazarusPhp\Requests\Psr\HttpKernel;

class HttpKernelProvider implements ProviderInterface
{
    public function register(Container $c):void
    {
        $c->singleton("httpKernel",function($c)
        {
            return HttpKernel::boot();
        });
    }
}