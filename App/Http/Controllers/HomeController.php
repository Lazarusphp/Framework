<?php
namespace App\Http\Controllers;

use App\Http\Model\Users;
use LazarusPhp\ServiceProvider\Application;
use LazarusPhp\ServiceProvider\Container;
use LazarusPhp\Templating\View;

class HomeController
{
    public function index()
    {
        // echo Application::get("sessions")->get("username");
        $user = Users::where("id",1)->with("posts")->first();
        $view = new View("Home/Index.php");
        echo $view->with("user",$user)->render();
    }


}