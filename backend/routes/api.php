<?php

global /** @var Router $router */
$router;

use RendyRobbani\Klinik\Kesjas\NTB\App\Controller\AuthController;
use RendyRobbani\Klinik\Kesjas\NTB\App\Controller\LayananController;
use RendyRobbani\Klinik\Kesjas\NTB\App\Middleware\AuthMiddleware;
use RendyRobbani\Klinik\Kesjas\NTB\App\Route\Router;

require_once __DIR__ . "/../vendor/autoload.php";

$router->post("/login", AuthController::class, "login");

$router->get("/layanan", LayananController::class, "selectAll", [AuthMiddleware::class]);
$router->get("/layanan/{id}", LayananController::class, "selectById", [AuthMiddleware::class]);