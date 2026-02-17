<?php

use LazarusPhp\DateManager\Date;

function LoadIni($displayErrors=false)
{
    $iniErrors = [
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

    
    foreach($iniErrors as $key => $error)
    {
        ini_set($key,$error);
    }

    if($displayErrors === true)
    {
        dd($iniErrors);
    }
     error_reporting(E_ALL);
}

function env(string $value)
{
    if(!isset($_ENV[$value]))
    {
        throw new LogicException("Env $value Not Found");
    }
    else{
    return $_ENV[$value];
    }
}

 function dd(array $data,$json=false)
 {
        if($json==true){
        header("content-type:application/json");
        echo json_encode($data,JSON_PRETTY_PRINT);
    }
    else{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    }
}

function slug($slug)
{
    return str_replace(" ","-",$slug);
}

function redirect($location)
{
     header("location:/$location");
}

function currentTime($time="hours|minute")
 {
     $timedformat = [];
//     Current Format is utc
    $date = "y-m-d";
//    $time = "h:i:s";
    $explode = explode("|",$time);
    if(!isset($output))
    {
        $output = [];
    }
    
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

 function devMode()
 {
    if(env("dev_mode") === "1")
    {
        return true;
    }
    return false;
 }


?>