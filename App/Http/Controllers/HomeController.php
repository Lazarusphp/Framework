<?php
namespace App\Http\Controllers;
use App\Http\Model\Model;
use App\System\Classes\Templating\Views;

class HomeController extends Model
{
    public function index(Views $view)
    {
        echo $view->render("/test.php");
    }


}