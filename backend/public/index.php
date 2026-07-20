<?php

use RendyRobbani\Klinik\Kesjas\NTB\App\Route\Router;

require_once __DIR__ . "/../vendor/autoload.php";

$router = new Router();
require __DIR__ . "/../routes/api.php";
$router->dispatch();