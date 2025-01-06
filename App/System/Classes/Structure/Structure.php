<?php

namespace App\System\Classes\Structure;

use App\System\App;
use App\System\Classes\ErrorHandler;
use Closure;
use FireCore\IniWriter\Handler;


class Structure extends StructureConfig
{

    private static $path;
    private static $data = [];
    
    private static $toFile = [];
    public function __construct()
    {
        $this->generateRoot();
        $this->generatePaths();
        self::create("Users",["username"=>"martin","Password"=>"Password"]);
    }

    public static function ModifyKey(string $name, string $key, mixed $value, $isfile = false)
    {
        if ($isfile === true) {
            Handler::open(self::$path[$name], true);
            Handler::set($name, $key, $value);
            Handler::save();
            Handler::close();
        } else {
            if (array_key_exists($key, self::$data[$name])) {
                self::$data[$name][$key] = $value;
            } else {
                Self::$data[$name][$key] = $value;
            }

        }
    }


    public static function create(string $name, array $data, $toFile=""): void
    {
        // Generate Array
        self::$data[$name] = $data;
     
        // Save to Ini File.

        if($toFile !== "")
        {
            echo "saving to file";
            self::$path[$name] = $toFile;
            self::$toFile[$name] = true;
            // Open the file
            Handler::open(self::$path[$name]);
            foreach ($data as $key => $value) {
                Handler::set($name, $key, $value);
            }

            // Save File
            Handler::save();
            // Close the  Handler
            Handler::close();
        }
        else
        {
            self::$toFile[$name] = false;
            foreach (self::$data[$name] as $key => $value) {
                self::$data[$name][$key] = $value;
            }
        }   
        
   
    }

    public static function mapPath($file,$name)
    {
        self::$path[$name] = $file;
        self::$toFile[$name] = true;
    }


    public static function fetch(string $name, mixed $key)
    {

            if (self::$toFile[$name] === true) {
                    Handler::open(self::$path[$name]);
                    return Handler::get($name, $key);
            }
            else
            {
                if(array_key_exists($key,self::$data[$name])){
                return self::$data[$name][$key];
                }
                else
                {
                    trigger_error("Key $key does not exist in the Array");
                }
            }
        }
    //Todo Add Private Generate Root path Here

    protected  function generateRoot():void
    {

        $allowedDir = ["public_html", "public", "www"];

        foreach ($allowedDir as $dir) {
            if (is_dir("../$dir")) {
                $explode = explode(DIRECTORY_SEPARATOR, getcwd());
                array_pop($explode);
                $this->root = implode(DIRECTORY_SEPARATOR, array: $explode);
            }
        }

        // Generate the Root Container;
        define("ROOT", $this->root);
    }


    public function hasFile($name): bool
    {
        if (file_exists($name) && is_file($name)) {
            return true;
        } else {
            return false;
        }
    }

    public function hasDirectory($name): bool
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
