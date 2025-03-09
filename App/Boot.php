<?php

namespace App;
use App\System\App;
use App\System\Classes\Security\Security;
use App\System\Classes\Requests\Requests;
use App\System\Classes\Validation\Validation;
use FireCore\FileWriter\Writer;

class Boot
{

    public static function run()
    {
        $app = new App();
        if($app->versionControl())
        {
            //Detect and update versionControl
            echo "versincontrol";
        }
        $app->loadRouter();
        // Code to run the application
    }

    public static function loadVc()
    {
    }
}