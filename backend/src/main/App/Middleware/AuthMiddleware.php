<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use RendyRobbani\Klinik\Kesjas\NTB\App\Config\ApplicationConfig;
use RendyRobbani\Klinik\Kesjas\NTB\App\Context\ApplicationContext;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\UnauthorizedException;

class AuthMiddleware
{
	public function handle(): void
	{
		try {
			$token = $_SERVER["HTTP_AUTHORIZATION"] ?? null;
			if ($token == null || strlen($token) < 7) throw new UnauthorizedException();
			$token = substr($token, 7);

			$config = ApplicationConfig::security();
			$decoded = JWT::decode($token, new Key($config->secretKey(), "HS256"));

			ApplicationContext::setIdUser($decoded->id);
		} catch (\Throwable) {
			throw new UnauthorizedException();
		}
	}
}