<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Context;

use RendyRobbani\Klinik\Kesjas\NTB\App\Connection\Connection;
use RendyRobbani\Klinik\Kesjas\NTB\App\Repository\UserRepository;
use RendyRobbani\Klinik\Kesjas\NTB\App\Repository\UserRepositoryImpl;
use RendyRobbani\Klinik\Kesjas\NTB\App\Service\AuthService;
use RendyRobbani\Klinik\Kesjas\NTB\App\Service\AuthServiceImpl;

class ApplicationContext
{
	private function __construct()
	{
	}

	/**
	 * @var UserRepository|null
	 */
	private static null|UserRepository $userRepository = null;

	/**
	 * @return UserRepository
	 * @throws \Exception
	 */
	public static function userRepository(): UserRepository
	{
		if (self::$userRepository === null) self::$userRepository = new UserRepositoryImpl(Connection::instance());
		return self::$userRepository;
	}

	/**
	 * @var string|null
	 */
	private static null|string $idUser = null;

	/**
	 * @return string|null
	 */
	public static function getIdUser(): null|string
	{
		return self::$idUser;
	}

	/**
	 * @param string|null $idUser
	 * @return void
	 */
	public static function setIdUser(null|string $idUser): void
	{
		self::$idUser = $idUser;
	}

	/**
	 * @var AuthService|null
	 */
	private static null|AuthService $authService = null;

	/**
	 * @return AuthService
	 * @throws \Exception
	 */
	public static function authService(): AuthService
	{
		if (self::$authService === null) self::$authService = new AuthServiceImpl(self::userRepository());
		return self::$authService;
	}
}