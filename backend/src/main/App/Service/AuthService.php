<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Service;

use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\BadRequestException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\UnauthorizedException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Request\LoginRequest;

interface AuthService
{
	/**
	 * @param LoginRequest $request
	 * @return void
	 * @throws UnauthorizedException|BadRequestException
	 */
	function login(LoginRequest $request): void;
}