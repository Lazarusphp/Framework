<?php
namespace ElegenceIO\Bootstrap\Processing;

use ElegenceIO\Console\Console as ElegenceIOConsole;
use ElegenceIO\Containers\Container;
use ElegenceIO\Foundation\Parsers\Env;
use ElegenceIO\Logger\Log;
use ElegenceIO\FileSystem\Cache\Cache;
use ElegenceIO\Foundation\Psr\Requests;
use ElegenceIO\Contracts\Console\Console;
use ElegenceIO\Database\Database;

class Binding
{

    public function __construct(private ?Container $container,private array $data)
    {
        $this->container = $container;
        $this->data = $data;
    }

    /**
     * Return continers only available to both http and cli actions.
     * @return array
     * @default []
     */

    public function shared():array
    {
        return [
            "env"=> $this->container->bind("env", new Env($this->data["basepath"])),
            "logger"=> $this->container->bind("logger",new Log($this->data["basepath"]."/Storage/Logs")),
            "cache"=>$this->container->bind("cache",new Cache($this->data["basepath"]."/Storage/Cache")),
            ];

    }

    
    /**
     * Return continers only available to http based actions.
     * @return array
     * @default []
     */
    public function http():array
    {
        return [
        ];

    }

    /**
     * Return continers only available to command line based actions.
     * @return array
     * @default []
     */
    public function cli():array
    {
        return [
        ];
    }


}
