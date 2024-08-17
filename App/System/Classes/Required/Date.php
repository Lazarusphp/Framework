<?php
namespace App\System\Classes\Required;

use App\System\Core;
use DateInterval;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Exception;

class Date
{
    public $version = "1.0";
    public $filename = __FILE__;

    /**
     * 
     * @property mixed $timezone;
     * @property mixed $date
     * @property mixed $instance static
     */

    // Generate the properties
    private $date;
    private $settimezone;
    private $dtz;


//  Set Default timezone;
 

    // Create private Constructor
    public function __construct()
    {
        $this->dtz = "Europe/London";
    }

    // Add Setter for Date time;
    // Use to change the timezone Mid Code

    private function LoadTimeZone($timezone)
    {
        try{
        return new DateTimeZone($timezone);
    }
    catch(Exception $e)
    {
        throw new Exception($e->getMessage());
    }
    }


    // Create Custom functions for Date and timeZone;

    public function AddDate($date,$tz=null)
    {
        is_null($tz) ? $timezone = $this->dtz : $timezone = $tz;
        // Return The DateTime Method
        return new DateTime($date,$this->LoadTimeZone($timezone));                                                                                          
    }

// Command Based Functions;

    // get Difference between two times.
    public function GetDifference( $start,  $target,  $format)
    {       
        $s = $start;
        $t = $target;
        return $s->diff($t);

    }

// Return Date time Interval
    public function ReturnInterval($format)
    {
        return new DateInterval($format);
    }

    // Create New Interval !Needs works still
    public function AddInterval($date,$value,$command=null)
    {

        is_null($command) ? $c="" : $c="T";
         return $date->add($this->ReturnInterval("P".$c.$value));
        
    }
    
    // Reverse of the Above Subtract intervals !Needs works
    public function SubInterval($date,$value,$command=null)
    {

        is_null($command) ? $c="" : $c="T";
         return $date->sub($this->ReturnInterval("P".$c.$value));
    }
// 


}