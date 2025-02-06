<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\TVSeriesRepository;
use DateTime;
use Exception;

class TVSeriesService {
    private TVSeriesRepository $repository;

    public function __construct(TVSeriesRepository $repository) {
        $this->repository = $repository;
    }

    public function getNextAiring(string|null $title, string|null $dateTime): string {
      
        if ($dateTime) {
      
        	if(strtotime($dateTime)){
        	
        		 $validDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateTime);
        		 $dateTimeShow = $validDateTime->format('Y-m-d H:i:s');
        	}else{
        		return json_encode(['error' => 'Invalid Date Format']);
        	}
            
           
        } else {
           
            $validDateTime = new DateTime();
            $dateTimeShow = $validDateTime->format('Y-m-d H:i:s');
        }
        
        // IF the title is not null
        if (isset($title) && !empty($title)) {
          $title = trim($title); 

          if (!preg_match('/^[a-zA-Z0-9\s\-]+$/', $title)) {
             return json_encode(['error' => 'Invalid Title: Only letters, numbers, spaces, and hyphens allowed']);
          }
        }
        
        return $this->repository->getNextAiring($title, $dateTimeShow);
    }
}
