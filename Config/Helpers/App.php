<?php

use LazarusPhp\Foundation\PathResolver\Resolve;
use LazarusPhp\SessionManager\Sessions;

function loadFile()
{
    return false;
}


function router()
{
    include_once(Resolve::get("Config")."/Router.php");
}

function session()
{
    return Sessions::create();
}

function auth()
{
    // Will be used for authentication
}