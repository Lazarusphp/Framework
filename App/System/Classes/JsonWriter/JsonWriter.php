<?php

namespace App\System\Classes\JsonWriter;

class JsonWriter
{
    // Class implementation will go here
    private static $data = [];
    private static $path = [];
    private static $name;


    public static function bindFile($name,$filename)
    {
        self::$path[$name] = $filename;
    }

    public function __construct($name)
    {
        self::$name = $name;   
        $this->parseJsonFile();
    }

    public function parseJsonFile()
    {
        $name = self::$name;
        $file = file_get_contents(self::$path[$name]);
        foreach (json_decode($file,false) as $section => $values) {
            foreach ($values as $key => $value) {
                self::$data[$section][$key] = $value;
            }
        }    
    }

    public function set($section,$key,$value)
    {
        self::$data[$section][$key] = $value;
    }

    public function get($section,$key)
    {
        return self::$data[$section][$key];
    }

    public function save()
    {
        $name = self::$name;
        $file = json_encode(self::$data,JSON_PRETTY_PRINT);
        self::$data = [];
        return file_put_contents(self::$path[$name],$file);
    }
}