<?php

namespace App\System\Classes\Security;

use App\System\Classes\Requests\Requests;
use App\System\Classes\Validation\Validation;

class Security
{
    private $token;

    public function __construct()
    {
        // Generate a New Token
        $this->token = bin2hex(random_bytes(32));
    }

    public function getToken()
    {
        return $this->token;
    }

    public function verifyToken($session, $token)
    {
        return (hash_equals($session, $token)) ? true : false;
    }



    public function tokenInput()
    {
        echo '<input type="text" name="csrf_token" value="' . $this->GetToken() . '">';
    }

    public function hash($password, $encryption = PASSWORD_DEFAULT)
    {
        return password_hash($password, $encryption);
    }

    public function VerifyHash($local, $remote)
    {
        return (password_verify($local, $remote) == true) ? true : false;
    }

    
}
