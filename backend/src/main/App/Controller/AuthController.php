<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Controller;

use RendyRobbani\Klinik\Kesjas\NTB\App\Context\ApplicationContext;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\BadRequestException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\UnauthorizedException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Request\LoginRequest;
use RendyRobbani\Klinik\Kesjas\NTB\App\Service\AuthService;

class AuthController extends AbstractController
{
	/**
	 * @var AuthService
	 */
	private AuthService $authService;

	/**
	 * @throws \Exception
	 */
	public function __construct()
	{
		parent::__construct();
		$this->authService = ApplicationContext::authService();
	}

	/**
	 * @return void
	 * @throws BadRequestException
	 * @throws UnauthorizedException
	 */
	public function login(): void
	{
		$request = json_decode(file_get_contents('php://input'), true);
		$this->authService->login(new LoginRequest(
			username: $request["username"] ?? null,
			password: $request["password"] ?? null),
		);
		$this->sendJson();
	}
}