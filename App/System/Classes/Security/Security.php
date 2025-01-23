<?php

namespace App\System\Classes\Security;

use App\System\Classes\Requests\Requests;
use App\System\Classes\Validation\Validation;

class Security
{
    private $token;
    private static $key = "";
    private static $cipher = 'AES-256-CBC';

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


    public static function encryptValue($value)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$cipher));
        $encrypted = openssl_encrypt($value, self::$cipher, self::$key, 0, $iv);
    
        // Combine IV and encrypted value for decryption later
        return base64_encode($iv . $encrypted);
    }
    
    public static function decryptValue($value)
    {
        $decoded = base64_decode($value);
    
        // Extract IV and encrypted data
        $iv_length = openssl_cipher_iv_length(self::$cipher);
        $iv = substr($decoded, 0, $iv_length);
        $encrypted = substr($decoded, $iv_length);
    
        return openssl_decrypt($encrypted, self::$cipher, self::$key, 0, $iv);
    }
    
}
