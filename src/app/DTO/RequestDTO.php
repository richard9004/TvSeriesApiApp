<?php

declare(strict_types=1);

namespace App\DTO;

class RequestDTO {

    public function __construct(
        public ?string $title,
        public ?string $datetime
    ) {}
}


?>