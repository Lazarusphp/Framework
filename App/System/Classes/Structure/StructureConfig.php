<?php

namespace App\System\Classes\Structure;

class StructureConfig
{
    protected $root;
    protected $paths = [];

    protected function newConstant($name, $value)
    {  $name = strtoupper($name); {
        if(!defined($name))
            return  define($name, $value);
        }
    }

    public function loadPaths()
    {
        // Dynamically Generate Defines
        foreach ($this->paths as $key => $path) {
            if (array_key_exists($key, $this->paths)) {
             $this->newConstant($key,$path);
            }
        }
    }

    public function countPaths()
    {
        return count($this->paths);
    }
    // generate Predefines Paths 

    protected function generatePaths()
    {
        $this->paths = [
            "root" => "$this->root",
            "router" => $this->root . "/App/System/Router/router.php",
            "config" => $this->root . "/Configs",
            "uploads" => $this->root . "/Assets/Uploads",
            "views" => $this->root . "/Views",
            "cache" => $this->root . "/Cache",
            "functions"=>$this->root."/App/functions.php"
        ];
    }

    // generate Root Path

    protected function generateRoot()
    {

        $allowedDir = ["public_html","public"];

        foreach ($allowedDir as $dir)
        {
            if(is_dir("../$dir"))
                {
                    $explode = explode("/", getcwd());
                    array_pop($explode);
                    $this->root = implode("/", $explode);
                }
        }

        return $this->root;
    }
}
