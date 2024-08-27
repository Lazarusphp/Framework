<?php
namespace App\Http\Controllers;
use App\Http\Model\Users;
use App\System\Classes\Templating\Views;

class HomeController
{
    public function index()
    {
      $users = new Users();
  
$users = $users->table("users")->findById(1)->save();
    }



}