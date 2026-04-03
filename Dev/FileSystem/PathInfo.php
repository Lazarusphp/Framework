<?php
namespace LazarusPhp\FileSystem;

class PathInfo
{

    private function info(string $path,mixed $flags="")
    {
        $flags = match($flags)
        {
            "extension" => PATHINFO_EXTENSION,
            "filename" => PATHINFO_FILENAME,
            "basename" => PATHINFO_BASENAME,
            "directory" => PATHINFO_DIRNAME,
            default => PATHINFO_ALL,
        };

        return pathinfo($path,$flags);
    }
  

    public function getExtension(string $file):string
    {
        return $this->info($file,"extension");
    }
    
    public function getFilename(string $file):string
    {
        return $this->info($file,"filename");
    }

    public function getBasename(string $file):string
    {
        return $this->info($file,"basename");
    }
    
    public function getDirectory(string $file):string
    {
        return $this->info($file,"directory");
    }
    

    /**
     * @return array;
     * @method all();
     */
    public function all($file):array
    {
        return $this->info($file);
    }
}