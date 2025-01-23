<?php
namespace App\Http\Model;
use LazarusPhp\QueryBuilder\Core;

class Model extends Core
{
    protected $allowed = ["email","username"];
    protected $filtered = ["password"];
}