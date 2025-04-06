<?php

namespace App;

use App\System\App;
use App\System\Classes\Requests\Requests;
use App\System\Classes\VersionControl\VersionControl;
use App\System\Writers\SessionWriter;
use LazarusPhp\LazarusDb\Connection;
use LazarusPhp\LazarusDb\QueryBuilder;

use LazarusPhp\SessionManager\Sessions;
use LazarusPhp\SessionManager\SessionsFactory;

class Boot
{

    public static function run()
    {
        $app = new App();
        if($app->versionControl())
        {
           self::loadVc();
        }

        $app->loadDatabase(ROOT."/Configs/Config.php");

        SessionsFactory::instantiate([SessionWriter::class],["table" => "sessions","days" => 30]);
        SessionsFactory::set("username","mike");;
        $app->loadRouter();
        // Code to run the application
    }

    public static function loadVc()
    {
        $classes = [
            'Requests' => Requests::class,
            'VersionControl' => VersionControl::class,
        ];

        foreach ($classes as $name => $class) {
            if (class_exists($class)) {
                $instance = new $class();
                if (property_exists($instance, 'vname') && property_exists($instance, 'vno') && property_exists($instance, 'lup')) {
                 
                    Writer::generate("Versions", function($writer) use ($instance)
                    {
                        $vname = str_replace(" ","_",$instance->vname);
                        $vno = $instance->vno;
                        $lup = $instance->lup;
                        $writer->section($vname)->set("version_number", $vno);
                        $writer->section($vname)->set("last_updated", $lup);
                        $writer->save();
                    });
                } else {
                    echo "$name class does not have all required properties.\n";
                }
            } else {
                echo "$name class does not exist.\n";
            }
        }
    }
}