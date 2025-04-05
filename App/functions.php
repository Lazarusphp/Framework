<?php
use LazarusPhp\DateManager\Date;
function slug($slug)
{
    return str_replace(" ","-",$slug);
}

 function redirect($location)
{
     header("location:/$location");
}

 function now($time="hours|minute")
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

function iniControl()
{
    $errors =[
        "display_errors"=>1,
        "display_startup_errors"=>1,
    ];

    foreach($errors as $key => $error)
    {
        ini_set($key,$error);
    }

    error_reporting(E_ALL);
}

function dd($value,$json=false)
{
    if($json==true){
        header("content-type:application/json");
        return json_encode($value,JSON_PRETTY_PRINT);
    }
    else{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}
}