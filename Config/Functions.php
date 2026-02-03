<?php

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
?>