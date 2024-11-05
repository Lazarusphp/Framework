<?php
namespace App\System\Classes\Structure;
use App\System\Classes\ErrorHandler;
use function PHPSTORM_META\elementType;
class Structure extends StructureConfig
{
    public function __construct()
    {
        $this->generateRoot();
        $this->generatePaths();
    }
    public function __set($name, $path)
    {
        $this->paths[$name] = $path;
        $this->newConstant($name, $path);
    }
    public function __get($name)
    {
        if(array_key_exists($this->paths,$name))
        {
            return $this->paths[$name];
        }
    }
    // Want to add a Path on the Fly use AddPath
    public function addPath($name, $path)
    {
        $this->paths[$name] = $path;
        $this->newConstant($name, $path);
    }
    // Load Paths
 
    public function hasFile($name)
    {
        if (file_exists($name) && is_file($name)) {
            return true;
        } else {
            return false;
        }
    }
    public function hasDirectory($name)
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