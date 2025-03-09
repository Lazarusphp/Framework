<?php

namespace App\System\Classes\Requests;

use App\System\Classes\ErrorHandler;
use App\System\Classes\Validation\Validation;
use FireCore\FileWriter\Writer;

class Requests extends Validation
{
    private $params = [];
    private $method = [];
    private $name;
    private $continue;


    public $vname = 'Request Manager';
    public $vno = '1.0.0';
    public $lup = "09/03/2025";


    // Request Constructor
    public function  __construct()
    {
        $this->continue = true;
    }


    public function validateParams($name, string $params)
    {
        $params = $this->explodeParams($params);

        if (isset($params->required)) {
            if ($params->required == true) {
                if (empty($name)) {
                    $this->continue = false;
                    $this->error[] = "Reqired Field: value cannot be empty";
                }
            }
        }

        if(isset($params->password))
        {
            if($params->password == true)
            {
                if($this->hasStrongPassword($name,"uppercase|lowercase|number|specials|min") == false)
                {
                    $this->continue = false;
                    $this->error[] = "Passowrd Input Does not Follow Requirments";
                }
            }
        }
        // Continue

        if (isset($params->email)) {
            if ($params->email == true) {
                if (!$this->validateEmail($name)) {
                    $this->continue = false;
                    $this->error[] = "Valid Email Required for " . $this->name;
                }
            }
        }
    }

    public function post($name, $params = null)
    {
        $this->name = $name;
        (isset($_POST[$name])) ? $this->method["post"] = $_POST[$name] :  $this->method["post"] = null;

        if (!is_null($params)) {
            $this->validateParams($this->method["post"], $params);
        }
        $this->name = null;
        if ($this->continue == true) {
            return $this->method["post"];
        } else {
        }
    }

    /**
     * Get Request Method
     *
     * @param [type] $name
     * @return void
     */
    public function get(string $name, ?string $params=null)
    {
        (isset($_GET[$name])) ? $this->method["get"] = $_GET[$name] :  $this->method["get"] = null;

        if (!is_null($params)) {
            $this->validateParams($this->method["get"], $params);
        }

        if ($this->continue == true) {
            return $this->method["get"];
        } else {
            echo "failed";
        }
    }
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function explodeParams($params)
    {
        $explode = explode("|", $params);

        foreach ($explode as $exploded) {
            $this->params[$exploded] = true;
        }

        return (object) $this->params;
    }


    // Call this method at the end to allow the statement to continue.



    public function any($name, $params = null)
    {
        (isset($_REQUEST[$name])) ? $this->method["any"] = $_REQUEST[$name] : $this->method["any"] = null;


        if (!is_null($params)) {
            $this->validateParams($this->method["any"], $params);
        }

        if ($this->continue == true) {
            return $this->method["any"];
        } else {
            echo "failed";
        }
    }
}
