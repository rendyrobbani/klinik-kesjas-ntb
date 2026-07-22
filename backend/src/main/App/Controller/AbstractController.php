<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Controller;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use RendyRobbani\Klinik\Kesjas\NTB\App\Config\ApplicationConfig;
use RendyRobbani\Klinik\Kesjas\NTB\App\Context\ApplicationContext;

abstract class AbstractController
{
	public function __construct()
	{
		$this->decodeToken();
	}

	private function encodeToken(): null|string
	{
		$idUser = ApplicationContext::getIdUser();
		if ($idUser == null) return null;

		$config = ApplicationConfig::security();
		return JWT::encode([
			"id" => $idUser,
			"exp" => time() + ($config->expiredTime() * 60),
		], $config->secretKey(), "HS256");
	}

	private function decodeToken(): void
	{
		try {
			if (ApplicationContext::getIdUser() != null) return;

			$token = $_SERVER["HTTP_AUTHORIZATION"] ?? null;
			if ($token == null || strlen($token) < 7) return;
			$token = substr($token, 7);

			$config = ApplicationConfig::security();
			$decoded = JWT::decode($token, new Key($config->secretKey(), "HS256"));
			ApplicationContext::setIdUser($decoded->id);
		} catch (\Throwable) {
		}
	}

	private function beforeSend(int $status): void
	{
		http_response_code($status);
		if ($token = $this->encodeToken()) setcookie("x-auth-token", $token, [
			"path" => "/",
		]);
	}

	public function sendJson(int $status = 200, string $message = "Ok", mixed $body = null): void
	{
		$this->beforeSend($status);
		header("Content-Type: application/json");
		if ($body === null) {
			$body = [];
			$body["status"] = $status;
			$body["message"] = $message;
		}
		echo json_encode($body);
	}
}