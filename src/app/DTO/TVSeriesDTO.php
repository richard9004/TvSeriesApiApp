<?php

declare(strict_types=1);

namespace App\DTO;

class TVSeriesDTO {
    public function __construct(
        public string $title,
        public string $channel,
        public string $weekDay,
        public string $showTime
    ) {}

}
?>