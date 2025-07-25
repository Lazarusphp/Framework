<?php
namespace App\System\Classes\Data;
/**
 * Class Strings
 * @package App\System\Classes\Data
 */

class Strings
{
    public static function isEmpty(string $value)
    {
        return (empty($value) ? true : false;
    }

    public static function isString($value)
    {
        return (is_string($value) ? true : false);
    }


    public static function makeUpper($value)
    {
        return strtoupper($value);
    }

    public static function makeLower($value)
    {
        return strtolower($value);
    }

    public static function isLower($value)
    {
        return self::isString($value) && $value === mb_strtolower($value, 'UTF-8');
    }

    public static function isUpper($value)
    {
        return self::isString($value) && $value === mb_strtoupper($value, 'UTF-8');
    }

    

}