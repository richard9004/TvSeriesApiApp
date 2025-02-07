<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TVSeriesRepository;
use App\DTO\RequestDTO;
use App\DTO\TVSeriesEntity;
use Exception;
use App\RequestValidator;


class TVSeriesController {
    private TVSeriesRepository $repository;

    public function __construct(TVSeriesRepository $repository) {
        $this->repository = $repository;
    }

    public function getNextAiring(RequestDTO $dto): ?TVSeriesEntity {
         
         RequestValidator::validate([
                'title' => $dto->title,
                'datetime' => $dto->datetime
         ], [
                'title' => 'alphanumeric',
                'datetime' => 'datetime'
         ]);

         return $this->repository->getNextAiring(
              $dto->title,
              $dto->datetime
          );
    
    }
}
