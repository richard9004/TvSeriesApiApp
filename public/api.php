<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\TVSeriesController;
use App\Repository\TVSeriesRepository;
use App\ErrorHandler;
use App\Database;
use App\DTO\RequestDTO;
use Dotenv\Dotenv;

set_exception_handler([ErrorHandler::class, 'handleException']);


header('Content-Type: application/json');

$dotEnv = Dotenv::createImmutable(dirname(__DIR__, 1)); 
$dotEnv->load();

$database = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);

$database->getConnection();

$repository = new TVSeriesRepository($database);
$controller = new TVSeriesController($repository);

$title = $_GET['title'] ?? null;
$datetime = $_GET['datetime'] ?? null;

$requestDTO = new RequestDTO($title, $datetime);

$dto = $controller->getNextAiring($requestDTO);

if ($dto) {
    echo json_encode([
        'title' => $dto->title,
        'channel' => $dto->channel,
        'weekDay' => $dto->weekDay,
        'showTime' => $dto->showTime,
    ]);
} else {
    echo json_encode(['message' => 'No upcoming show found']);
}
