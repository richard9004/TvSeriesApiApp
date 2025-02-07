<?php

declare(strict_types=1);

namespace App\DTO;

class ResponseDTO {
    public function __construct(
        public string $title,
        public string $channel,
        public string $weekDay,
        public string $showTime 
    ) {}



}
