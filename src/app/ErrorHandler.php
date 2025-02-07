<?php

declare(strict_types=1);

namespace App;
use Throwable;

class ErrorHandler {
    public static function handleException(Throwable $exception): void { 
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode([
            'error' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ]);
    }
}
