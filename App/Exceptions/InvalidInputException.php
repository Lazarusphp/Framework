<?php
namespace App\Exceptions;
use LazarusPhp\Exceptions\CoreFiles\ExceptionCore;
use Psr\Log\LoggerInterface;
use Throwable;

class InvalidInputException extends ExceptionCore
{
    protected string $directory = "";

    // Directory Status Code 403
    protected int $statuscode = 500;
    
    public function __construct(string $input)
    {
        $this->directory = $input;
        parent::__construct("Ivalid Input Request : {$input}", $this->statuscode);
    }


}