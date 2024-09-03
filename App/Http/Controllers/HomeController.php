<?php
namespace App\Http\Controllers;
use App\Http\Model\Users;
use App\System\Classes\Requests\Requests;
use App\System\Classes\Templating\Views;
use Couchbase\User;

class HomeController
{
    public function index(Views $views)
    {
      $users = new Users();
  
    $users = $users->select()->get();
    $views->users = $users;
    echo $views->render("/users/newuser.php");
    }

    public function insert(Requests $request)
    {
        $request->username = $request->post("username");
        $request->save();
        $users = new Users();
        $users->username = $request->username;
        $users->insert()->save();
        header("location:/");

    }

    public function update($id)
    {
        $id = base64_decode($id);
        if((new Users())->findOrFail($id))
        {
            echo "user found";
        }
    }

    public function updatePost()
    {

    }

    public function delete($id)
    {
        $id = base64_decode($id);
        $users = new Users();
        if($users->findOrFail($id)) {
            (new Users())->delete()->where("id",$id)->save();
            header("location:/");
        }
        else
        {
            echo "failed";
        }
    }


}