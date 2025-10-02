<?php

namespace App\System\Core;

class Files
{


    public static function hasFile(string $name): bool
    {
        return (file_exists($name) && is_file($name)) ? true : false;
    }

    public static function hasDirectory(string $name): bool;
    {
        return (is_dir($name) && is_readable($name)) ? true : false;
    }

    public function createDirectory(string $name,int $mode = 0755, bool $recursive = true): void
    {
        if(is_dir($name) && is_writable($name))
        {
            mkdir($name,$mode)
        }
        else
        {
            // Set Error Handler Here For Directory Failed to Create
        }
    }
}