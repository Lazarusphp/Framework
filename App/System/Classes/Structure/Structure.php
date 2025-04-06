<?php

namespace App\System\Classes\Structure;

use App\System\App;
use App\System\Classes\ErrorHandler;
use Closure;
use FireCore\IniWriter\Handler;


class Structure
{

    private static $root;

    //Todo Add Private Generate Root path Here

    protected static function generateRoot():void
    {

        $allowedDir = ["public_html", "public", "www"];

        foreach ($allowedDir as $dir) {
            if (is_dir("../$dir")) {
                $explode = explode(DIRECTORY_SEPARATOR, getcwd());
                array_pop($explode);
                self::$root = implode(DIRECTORY_SEPARATOR, array: $explode);
            }
        }

        // Generate the Root Container;
        define("ROOT", self::$root);
    }


    public static function hasFile($name): bool
    {
        if (file_exists($name) && is_file($name)) {
            return true;
        } else {
            return false;
        }
    }

    public static function hasDirectory($name): bool
    {
        //   echo "<ol>";
        if (!is_file($name)) {
            echo "</ol>";
            if (is_dir($name)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
