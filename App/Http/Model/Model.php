<?php
namespace App\Http\Model;
use LazarusPhp\DatabaseManager\Database;

class Model extends Database
{
    protected $hidden = ["id","password"];

    
}