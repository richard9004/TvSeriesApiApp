<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Database;
use App\Repository\TVSeriesRepository;
use App\Service\TVSeriesService;

header('Content-Type: application/json');

$database = new Database();
$repository = new TVSeriesRepository($database);
$service = new TVSeriesService($repository);

$title = $_GET['title'] ?? null;
$dateTime = $_GET['datetime'] ?? null;

$nextAiring = $service->getNextAiring($title, $dateTime);
if (is_string($nextAiring)) {
    echo $nextAiring;
    exit;
}