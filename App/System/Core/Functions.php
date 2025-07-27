<?php

namespace App\System\Core;
use LazarusPhp\DateManager\Date;
class Functions
{

    private static $iniConfig = [
        "display_errors"=>1,
        "display_startup_errors"=>1,
        "error_reporting" => E_ALL,
        "log_errors" => 1,
        "ignore_repeated_errors" => 1,
        "html_errors" => 0,
        "memory_limit" => "256M",
        "max_execution_time" => 60,
        "post_max_size" => "8M",
        "upload_max_filesize" => "8M",
        "date.timezone" => "GMT"
    ];

   public static function now($time="hours|minute")
 {
     $timedformat = [];
//     Current Format is utc
    $date = "y-m-d";
//    $time = "h:i:s";
    $explode = explode("|",$time);
    foreach ($explode as $t)
    {
        $timedformat[$t] = true;
    }

    $time = (object) $timedformat;
    if(isset($time->hours))
    {
        ($time->hours == true) ? $output[] = "H" : $output[] =  "";
    }

     if(isset($time->minute))
     {
         ($time->minute == true) ? $output[] = "i" : $output[] = "" ;
     }

     if(isset($time->seconds))
     {
         ($time->seconds == true) ? $output[] = "s" : $output[] = "";
     }
     $time = implode(":",$output);
     return Date::create("now")->format("$date $time");
 }

 public static function iniControl()
{
    $errors = self::$iniConfig;
    
    foreach($errors as $key => $error)
    {
        ini_set($key,$error);
    }

    error_reporting(E_ALL);
}

public static function dd($value,$json=false)
{
    if($json==true){
        header("content-type:application/json");
        echo json_encode($value,JSON_PRETTY_PRINT);
    }
    else{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}
}

public function slug($slug)
{
    return str_replace(" ","-",$slug);
}

 public static function redirect($location)
{
     header("location:/$location");
}

}