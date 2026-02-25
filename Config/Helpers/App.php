<?php

use LazarusPhp\Foundation\PathResolver\Resolve;

function loadFile()
{
    return false;
}


function loadRouter()
{
    include_once(Resolve::get("Config")."/Router.php");
}