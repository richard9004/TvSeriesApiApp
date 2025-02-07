<?php

declare(strict_types=1);

namespace App;

use Exception;

class RequestValidator {
    public static function validate(?string $title, ?string $datetime): void {
    	
        if (!empty($title) && !preg_match('/^[a-zA-Z0-9\s\-]+$/', $title)) {
            throw new Exception('Invalid Title: Only letters, numbers, spaces, and hyphens allowed.');
        }

        if (!empty($datetime) && !strtotime($datetime)) {
            throw new Exception('Invalid Date');
        }
    }
}
