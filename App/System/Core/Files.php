<?php

namespace App\System\Core;

class Files
{

    /**
     * File Class 
     * Designed to handle files and directorys including creation and deletion
     * 
     * WIll most likely be renamed to Structure or something similar
     *
     * @var array
     */

    private static $directory = [];

    // Add Supported filetypes


    // Possibly Move this into a Constructor.
    public static function setFolder(string $name, string|int $value)
    {
        if(!isset(self::$directory[$name]) && !array_key_exists($name,self::$directory))
        {
            if(self::hasDirectory($value))
            {
                self::$directory[$name] = $value;
            }
            else
            {
                // Set Error Handler Here For Directory Not Readable or Not Writeable
                // Directory does not exisits
                echo "Directory Does not exist";
                return "";
            }
            self::$directory[$name] = $value;
        }
    }

    // This will not be needed if a constructor sets the root directory.
    public static function folder(string $name,string $value = "")
    {
        if(isset(self::$directory[$name]))
        {
            if(array_key_exists($name,self::$directory))
            {
                return self::$directory[$name];
            }
        }
    }

    private static function isWriteable($name): bool
    {
        return is_writable($name) ? true : false;
    }

    private static function isReadable($name):bool
    {
        return is_readable($name) ? true : false;
    }


    public static function hasFile(string $name): bool
    {
        return (file_exists($name) && is_file($name)) ? true : false;
    }

    public static function hasDirectory(string $name): bool
    {
        return (is_dir($name) && self::isReadable($name)) ? true : false;
    }
    
    /**
     * Create a directory looper to go backwards per path based on / or \ and  check if writable untile found and return errors.
     */

    public function createDirectory(string $name,int $mode = 0755, bool $recursive = true): void
    {
        if(is_dir($name) && is_writable($name))
        {
            mkdir($name,$mode);
        }
        else
        {
            // Set Error Handler Here For Directory Failed to Create
        }
    }
}