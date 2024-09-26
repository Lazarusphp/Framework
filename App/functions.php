<?php

function slug($slug)
{
    return str_replace(" ","-",$slug);
}

 function redirect($location)
{
     header("location:/$location");
}

