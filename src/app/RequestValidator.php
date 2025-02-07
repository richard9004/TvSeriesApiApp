<?php

declare(strict_types=1);

namespace App;

use Exception;
use DateTime;

class RequestValidator {
    public static function validate(array $data, array $rules): void {
        $errors = [];

        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? null;

            if ($rule === 'required' && empty($value)) {
                $errors[] = "Field '$field' is required.";
            }

            if ($rule === 'datetime' && !empty($value) && !self::isValidDateTime($value)) {
                $errors[] = "Field '$field' must be in format Y-m-d H:i:s.";
            }

            if ($rule === 'string' && !is_string($value)) {
                $errors[] = "Field '$field' must be a string.";
            }

            if ($rule === 'alphanumeric' && !empty($value) && !preg_match('/^[a-zA-Z0-9\s\-]+$/', $value)) {
                $errors[] = "Field '$field' can only contain letters, numbers, spaces, and hyphens.";
            }
        }

        if (!empty($errors)) {
            throw new Exception(json_encode(['errors' => $errors]));
        }
    }

    private static function isValidDateTime(string $dateTime): bool {
        return DateTime::createFromFormat('Y-m-d H:i:s', $dateTime) !== false;
    }
}
