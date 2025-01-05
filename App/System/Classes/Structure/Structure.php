<?php
namespace App\System\Classes\Structure;
use App\System\Classes\ErrorHandler;
use Closure;
use FireCore\IniWriter\Handler;

use function PHPSTORM_META\elementType;
class Structure extends StructureConfig
{

    private $dir = [];
    private $pathname = [];


    private static $path = [];
    private static $data = [];





    private $iniFile;
    public function __construct()
    {
        $this->generateRoot();
        $this->generatePaths();
    }


    public static function create($name,$file,array $data):void
    {
        self::$path[$name] = $file;
        // Set new Handler Instance
        self::$data[$name] = $data;
        // Open the Ini file,
        Handler::open($file);

        foreach($data as $key => $value)
        {
            Handler::set($name,$key,$value);
        }

        Handler::save();

        Handler::close();
        
    }
    public static function fetchValue($name,$key):mixed
    {
        Handler::open(self::$path[$name]);
        return Handler::get($name,$key);
    }



    public static function getPath($name=null)
    {
        if($name === null)
        {
            return self::$path;
        }
        else
        {
            return self::$path[$name]; 
        }
       
    }





    //TODO:  Generate an array to t ie in with the INI File Class
    private function defaultIni()
    {
        $this->dir = [
            "Storage" => ROOT. DIRECTORY_SEPARATOR ."Storage",
        ];


        var_dump($this->dir);
    }

    // TODO: Remove this method No longer needed
    public function __set($name, $path)
    {
        $this->paths[$name] = $path;
        $this->newConstant($name, $path);
    }

    // TODO: Remove this method No longer needed
    public function __get($name)
    {
        if(array_key_exists($this->paths,$name))
        {
            return $this->paths[$name];
        }
    }
    
    //TODO Remove this method
    public function addPath($name, $path)
    {
        $this->paths[$name] = $path;
        $this->newConstant($name, $path);
    }
    // Load Paths


    //Todo Add Private Generate Root path Here

    protected function generateRoot()
    {

        $allowedDir = ["public_html","public","www"];

        foreach ($allowedDir as $dir)
        {
            if(is_dir("../$dir"))
                {
                    $explode = explode(DIRECTORY_SEPARATOR, getcwd());
                    array_pop($explode);
                    $this->root = implode(DIRECTORY_SEPARATOR, $explode);
                }
        }

        define("ROOT", $this->root);
        return $this->root;
    }


    public function hasFile($name)  :bool  
    {
        if (file_exists($name) && is_file($name)) {
            return true;
        } else {
            return false;
        }
    }

    public function hasDirectory($name):bool
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