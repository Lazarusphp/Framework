<?php

namespace  App\System\Classes;

use App\System\Classes\ErrorHandler;
use App\System\App;

class Views
{

    private $data = [];
    private $views;
    private $templates;
    private $cache;

    public function __construct()
    {

        $app = new App();
        $this->views = VIEWS;
        $this->cache = CACHE;
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


    public function render($file, array $data = [])
    {
        $path = $this->views . $file;
        if ($this->ViewExists($path) == true) {
            // Check if $data is not empty
            if (count($data) > 0) {
                $this->data = $data;
            }
            // Check if the $data Variable is an empty array while Counting Arrays
            if (is_array($this->data)) {
                extract($this->data);
            }
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
