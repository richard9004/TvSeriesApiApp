<?php 

declare(strict_types=1);

namespace App\Repository;

use App\Database;
use App\DTO\TVSeriesDTO;
use PDO;
use DateTime;
use DateTimeImmutable;

class TVSeriesRepository {

    private PDO $db;

    public function __construct(Database $database) {
        $this->db = $database->connect();
    }

    public function getNextAiring(string|null $title, string $dateTimeShow): string {
        
        $inputElements = [':dateTimeShow' => $dateTimeShow];
        $query = "SELECT ts.title, ts.channel, tsi.week_day, tsi.show_time
                  FROM tv_series_intervals tsi
                  JOIN tv_series ts ON ts.id = tsi.id_tv_series
                  WHERE tsi.show_time > :dateTimeShow"; 

       

        // Add title if not empty and exists
        if ($title) {
            $inputElements[':title'] = $title;
            $query .= " AND ts.title = :title";
        }

        $query .= " ORDER BY tsi.show_time ASC LIMIT 1";

       
        $statement = $this->db->prepare($query);
        $statement->execute($inputElements);

        // Fetch the data
        $result = $statement->fetch();

        // Return the dto object
        if ($result) {
            $data = new TVSeriesDTO(
                $result['title'],
                $result['channel'],
                $result['week_day'],
                $result['show_time']
            );
            return json_encode($data);
        } else {
            $data = array("message"=>"No records found");
            json_encode($data);
        }
        return $data;
    }
}
