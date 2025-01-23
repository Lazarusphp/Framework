<?php
namespace App\System\Classes\ErrorHandler;
use LazarusPhp\DatabaseManager\Database;

class ErrorControl extends Database 
{


     public static $error = []; 

    protected static $errorTypes = [
        E_ERROR => 'Error',
        E_WARNING => 'Warning',
        E_PARSE => 'Parse Error',
        E_NOTICE => 'Error Notice',
        E_CORE_ERROR => 'Core Error',
        E_CORE_WARNING => 'Core Warning',
        E_COMPILE_ERROR => 'Compile Error',
        E_COMPILE_WARNING => 'Compile Warning',
        E_USER_ERROR => 'User Error',
        E_USER_WARNING => 'User Warning',
        E_USER_NOTICE => 'User Notice',
        E_STRICT => 'Strict',
        E_RECOVERABLE_ERROR => 'Recoverable Error',
        E_DEPRECATED => 'Deprecated',
        E_USER_DEPRECATED => 'User Deprecated'
    ];

    protected static $useDbLog;
    protected static $displayErrors;


    public function GenerateErrorLog()
    {
        if(self::$useDbLog == true)
        {
            // Generate Code;
        }
    }

    
    public static function displayError($file,$linevalue)
    {
        $file = file_get_contents($file);
        $file = htmlspecialchars($file);
        $lines = explode("\n", $file);
       
        echo "<pre style='padding:0px; margin:auto;color:white;background-color:#515151; border:solid 1px #000; max-height:300px; width:80%; overflow-y:auto;'>";
        foreach ($lines as $lineNumber => $line)
        {
                if ($lineNumber + 1 == $linevalue) {
                    // Highlight the error line
                    echo "<div style='padding:0px; margin:0px; color:yellow;'>" . ($lineNumber + 1) . " : " . $line . "</div>  <br>";
                } else {
                    echo "<div style='color:white;'>";
                    echo ($lineNumber + 1) . ": " . $line . " <br>";
                    echo "</div>";
                    
                }
        }
                 echo "</pre>";
        }


    public static function handleError($errno, $errstr, $errfile, $errline) {
        // Match Error Code Number $errno with $error Type;
        $errorType = isset(self::$errorTypes[$errno]) ? self::$errorTypes[$errno] : 'Unknown Error';
        $output = "Error Type: $errorType <br>";
        $output .= "Error Message: $errstr <br>";
        $output .= "File: $errfile <br>";
        $output .=  "Line: $errline <br>"; 
        echo $output;
        self::$error[] = $output;
        if(self::$displayErrors == true)
        {
               self::displayError($errfile,$errline);
        }
     
        
        // Link this to the Database
        // Logs need adding
        // Prevent the PHP error handler from executing
        return true;
    }


}