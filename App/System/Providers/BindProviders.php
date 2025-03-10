<?php

namespace App\System\Providers;
use FireCore\DataHandler\Writer;
use FireCore\DataHandler\Writers\JsonWriter;

class BindProviders
{
    // Class implementation goes here


        public static function bind()
        {
            // Impove on this in the future;
            Writer::bind("Versions",ROOT."/Storage/Versions.json",[JsonWriter::class]);
        }
        
}