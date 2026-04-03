<?php
namespace LazarusPhp\FileSystem;
use Exception;

class Directories
{

    public function set(string $directory,int $mode=0755,bool $recursive=true):void
    {
        if($this->get($directory))
        {
            return;
        }

        if(!mkdir($directory,$mode,$recursive))
        {
                throw new Exception("Directory Creation Failed : $directory could not be created");
        }
    }

    public function get($directory)
    {
        return is_dir($directory) ? true : false;
    }

    
    public function delete(string $directory)
    {
        if(!$this->get($directory))return;
        $items = scandir($directory);
        foreach($items as $item)
        {
            if($item === "." || $item === "..") continue;
            $itemPath = $directory.DIRECTORY_SEPARATOR.$item;
            
            if(is_file($itemPath))
            {
                unlink($itemPath);
            }
            
            if(\is_dir($itemPath))
            {
                 rmdir($itemPath);
            }

            $this->delete($itemPath);
        }

        rmdir($directory);
    }

    public function list()
    {

    }

}