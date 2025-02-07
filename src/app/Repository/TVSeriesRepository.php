<?php 

declare(strict_types=1);

namespace App\Repository;

use App\Database;
use App\DTO\TVSeriesEntity;
use PDO;
use DateTimeImmutable;

class TVSeriesRepository {

    private PDO $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function getNextAiring(?string $title, string $dateTimeShow): ?TVSeriesEntity {
        
        $inputElements = [':dateTimeShow' => $dateTimeShow];
        $query = "SELECT ts.title, ts.channel, tsi.week_day, tsi.show_time
                  FROM tv_series_intervals tsi
                  JOIN tv_series ts ON ts.id = tsi.id_tv_series
                  WHERE tsi.show_time > :dateTimeShow"; 

        if ($title) {
            $inputElements[':title'] = $title;
            $query .= " AND ts.title = :title";
        }

        $query .= " ORDER BY tsi.show_time ASC LIMIT 1";

        $statement = $this->db->prepare($query);
        $statement->execute($inputElements);

        $result = $statement->fetch();

        if ($result) {
            return new TVSeriesEntity(
                $result['title'],
                $result['channel'],
                $result['week_day'],
                $result['show_time']
            );
        }

        return null;
    }
}