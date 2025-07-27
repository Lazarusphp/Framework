<?php

namespace App\System\Core;

class Files
{
    
    public static function hasFile($name): bool
    {
        if (file_exists($name) && is_file($name)) {
            return true;
        } else {
            return false;
        }
    }

    public static function hasDirectory($name): bool
    {
        if(is_dir($name) && is_readable($name)) {
            return true;
        } else {
            return false;
        }
    }
}