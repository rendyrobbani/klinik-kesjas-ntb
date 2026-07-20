<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Service;

use RendyRobbani\Klinik\Kesjas\NTB\App\Context\ApplicationContext;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\BadRequestException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\UnauthorizedException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Repository\UserRepository;
use RendyRobbani\Klinik\Kesjas\NTB\App\Request\LoginRequest;

class AuthServiceImpl implements AuthService
{
	private UserRepository $userRepository;

	/**
	 * @param UserRepository $userRepository
	 */
	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
	 * @inheritDoc
	 */
	function login(LoginRequest $request): void
	{
		if ($errors = $request->validate()) throw new BadRequestException($errors);
		$user = $this->userRepository->selectById($request->getUsername());
		if ($user == null || !password_verify($request->getPassword(), $user->getPassword())) throw new UnauthorizedException("Pengguna tidak ditemukan");
		ApplicationContext::setIdUser($user->getId());
	}
}