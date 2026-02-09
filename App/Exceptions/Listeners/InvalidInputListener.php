<?php
namespace App\Exceptions\Listeners;

use LazarusPhp\Exceptions\Exceptions\InvalidInputException;
use LazarusPhp\Logger\Level;
use LazarusPhp\Exceptions\Interfaces\ExceptionListenerInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class InvalidInputListener implements ExceptionListenerInterface
{
    private LoggerInterface $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function support(Throwable $e):bool
    {
        return $e  instanceof InvalidInputException;
    }
    

     public function handle(Throwable $e): void
    {
        if (!$e instanceof InvalidInputException) {
            return;
        }

        $this->logger->warning($e->getMessage(),
        ["file"=>$e->getFile(),
        "Status Code"=>$e->getStatusCode(),
        "ErrorCode" => $e->getCode(),
        "Level"=>Level::Warning->label(),
        ]);

        http_response_code($e->getStatusCode());
        echo json_encode([
            'error' => $e->getMessage(),
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'level'=> Level::Warning->label(),
        ],JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
    }
}