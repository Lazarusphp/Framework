<?php

namespace  App\System\Classes\Templating;
use App\System\Classes\Structure\Structure;

class Views
{

    private $data = [];
    private $views;
    private $devmode = [];
    private $cache;

    public function __construct()
    {
        $this->views = Structure::fetch("Paths","Views");
        $this->cache = Structure::fetch("Paths","Cache");
        // Create the folders

        $this->DetectFolder($this->views);
        $this->DetectFolder($this->cache);
    }


    private function DetectFolder($file)
    {
        if (!is_dir($file)) {
            return trigger_error("Folder :" . $file . " Does not exist");
        }
    }

    public function with($name,$value)
    {
         $this->data[$name] = $value;
         return $this;
    }
    
    public function __set($name, $value)
    {
        return $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        unset($this->data[$name]);
    }


    private function ViewExists($file)
    {
        return file_exists($file) ? true : false;
    }


    public function render($file):bool|string
    {
        $path = $this->views . $file;
        if ($this->ViewExists($path) == true) {
            // Check if $data is not empty
            // Check if the $data Variable is an empty array while Counting Arrays
            if (is_array($this->data)) {
                extract($this->data);
            }
            $this->devmode == true ? var_dump($this->data) : false;
            // Output the data to the Next Page 
            ob_start();
            require_once($path);
            return ob_get_clean();
        } else {
            // PassError if file Not Found.
            trigger_error("The File $path cannot be found:");
        }

        return $this;
    }


}
