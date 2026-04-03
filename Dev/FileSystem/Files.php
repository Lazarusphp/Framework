<?php
namespace LazarusPhp\FileSystem;

class Files
{

    public function set(string $filename,$data)
    {
        if(!is_file($filename))
            {
                // Thorw Error
            }

        return file_put_contents($filename,$data);
    }

    public function get(string $filename)
    {
        if(!$this->hasFile($filename))
        {
            echo "file Does not exist";
            // Throw Error
        }

        return file_get_contents($filename);
    }

    public function isFile($filename):bool
    {
        return is_file($filename) ? true : false;
    }

    public function hasFile($filename):bool
    {
        return file_exists($filename) ? true : false;
    }

    public function delete(string $filename,$context = null)
    {
        return unlink($filename,$context);
    }
    
}