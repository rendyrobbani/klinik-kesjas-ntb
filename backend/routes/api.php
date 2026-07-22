<?php

global /** @var Router $router */
$router;

use RendyRobbani\Klinik\Kesjas\NTB\App\Controller\AuthController;
use RendyRobbani\Klinik\Kesjas\NTB\App\Controller\LayananController;
use RendyRobbani\Klinik\Kesjas\NTB\App\Middleware\AuthMiddleware;
use RendyRobbani\Klinik\Kesjas\NTB\App\Route\Router;

require_once __DIR__ . "/../vendor/autoload.php";

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
//header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
	http_response_code(200);
	exit;
}

$router->post("/login", AuthController::class, "login");

$router->get("/layanan", LayananController::class, "selectAll", [AuthMiddleware::class]);
$router->get("/layanan/{id}", LayananController::class, "selectById", [AuthMiddleware::class]);
$router->post("/layanan", LayananController::class, "create", [AuthMiddleware::class]);
$router->post("/layanan/{id}", LayananController::class, "updateById", [AuthMiddleware::class]);
$router->delete("/layanan/{id}", LayananController::class, "deleteById", [AuthMiddleware::class]);