<?php

use LazarusPhp\AuthControl\Auth;
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

function session():object|bool
{
    return Sessions::create();
}

function auth()
{
    // return Auth::authenticate();
}