<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Route;

use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\BadRequestException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\NotFoundException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\UnauthorizedException;

class Router
{
	private array $routes;

	public function __construct(array $routes = [])
	{
		$this->routes = $routes;
	}

	public function get(string $path, string $controller, string $action, array $middleware = []): void
	{
		$this->addRoute("GET", $path, $controller, $action, $middleware);
	}

	public function post(string $path, string $controller, string $action, array $middleware = []): void
	{
		$this->addRoute("POST", $path, $controller, $action, $middleware);
	}

	public function put(string $path, string $controller, string $action, array $middleware = []): void
	{
		$this->addRoute("PUT", $path, $controller, $action, $middleware);
	}

	public function delete(string $path, string $controller, string $action, array $middleware = []): void
	{
		$this->addRoute("DELETE", $path, $controller, $action, $middleware);
	}

	private function addRoute(string $method, string $path, string $controller, string $action, array $middleware): void
	{
		$regex = preg_replace(
			"/\{([a-zA-Z0-9_]+)}/",
			"(?P<$1>[^/]+)",
			$path
		);

		$this->routes[] = [
			"method" => $method,
			"path" => $path,
			"regex" => "#^{$regex}$#",
			"controller" => $controller,
			"action" => $action,
			"middleware" => $middleware
		];
	}

	public function dispatch(): void
	{
		try {
			$method = $_SERVER["REQUEST_METHOD"];
			$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

			$path = preg_replace("#^/api#", "", $path);
			foreach ($this->routes as $route) {
				if ($route["method"] !== $method) continue;
				if (!preg_match($route["regex"], $path, $matches)) continue;

				$params = array_filter($matches, function ($key) {
					return !is_int($key);
				}, ARRAY_FILTER_USE_KEY);

				foreach ($route["middleware"] as $middlewareClass) {
					$middleware = new $middlewareClass();
					if (!$middleware->handle()) return;
				}

				$controller = new $route["controller"]();
				$controller->{$route["action"]}($params);

				return;
			}

			http_response_code(404);
			header("Content-Type: application/json");
			echo json_encode([
				"status" => 404,
				"message" => "Not Found",
			]);
			return;
		} catch (BadRequestException $badRequestException) {
			http_response_code(400);
			header("Content-Type: application/json");
			if ($badRequestException->getErrors() !== null && sizeof($badRequestException->getErrors()) > 0) echo json_encode($badRequestException->getErrors());
			else {
				echo json_encode([
					"status" => 400,
					"message" => $badRequestException->getMessage() ?? "Bad Request",
				]);
			}
		} catch (UnauthorizedException $unauthorizedException) {
			http_response_code(401);
			header("Content-Type: application/json");
			echo json_encode([
				"status" => 401,
				"message" => $unauthorizedException->getMessage() ?? "Unauthorized",
			]);
		} catch (NotFoundException $notFoundException) {
			http_response_code(404);
			header("Content-Type: application/json");
			echo json_encode([
				"status" => 404,
				"message" => $notFoundException->getMessage() ?? "Not Found",
			]);
		} catch (\Throwable $throwable) {
			http_response_code(500);
			header("Content-Type: application/json");
			echo json_encode([
				"status" => 500,
				"message" => $throwable->getMessage() ?? "Internal Server Error",
			]);
		}
	}
}