<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TVSeriesRepository;
use App\DTO\RequestDTO;
use App\DTO\ResponseDTO;
use Exception;
use App\RequestValidator;


class TVSeriesController {
    private TVSeriesRepository $repository;

    public function __construct(TVSeriesRepository $repository) {
        $this->repository = $repository;
    }

    public function getNextAiring(RequestDTO $dto): ?ResponseDTO {
     
       
        RequestValidator::validate($dto->title, $dto->datetime);

        if (empty($dto->datetime)) {
            $formatedDate = date('Y-m-d H:i:s');
        }else{
            $formatedDate = strtotime($dto->datetime);
            $formatedDate = date('Y-m-d H:i:s', $formatedDate);
        }

        return $this->repository->getNextAiring(
              $dto->title,
              $formatedDate
        );
    }
}
