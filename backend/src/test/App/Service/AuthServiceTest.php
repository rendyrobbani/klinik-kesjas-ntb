<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Service;

use PHPUnit\Framework\TestCase;
use RendyRobbani\Klinik\Kesjas\NTB\App\Context\ApplicationContext;
use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\UserEntity;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\BadRequestException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\UnauthorizedException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Repository\UserRepository;
use RendyRobbani\Klinik\Kesjas\NTB\App\Request\LoginRequest;

class AuthServiceTest extends TestCase
{
	private UserRepository $userRepository;

	private AuthService $service;

	protected function setUp(): void
	{
		$this->userRepository = $this->createMock(
			UserRepository::class
		);

		$this->service = new AuthServiceImpl(
			$this->userRepository
		);

		ApplicationContext::setIdUser(null);
	}

	protected function tearDown(): void
	{
		ApplicationContext::setIdUser(null);
	}

	public function testLoginSuccess(): void
	{
		$user = (new UserEntity())
			->setId("user-001")
			->setNama("Rendy")
			->setPassword(
				password_hash(
					"secret",
					PASSWORD_BCRYPT
				)
			)
			->setIsDeleted(false);

		$this->userRepository
			->expects($this->once())
			->method("selectById")
			->with("rendy")
			->willReturn($user);

		$request = new LoginRequest(
			"rendy",
			"secret"
		);

		$this->service->login(
			$request
		);

		$this->assertSame(
			"user-001",
			ApplicationContext::getIdUser()
		);
	}

	public function testLoginThrowBadRequestWhenUsernameIsEmpty(): void
	{
		$request = new LoginRequest(
			null,
			"secret"
		);

		$this->userRepository
			->expects($this->never())
			->method("selectById");

		$this->expectException(
			BadRequestException::class
		);

		$this->service->login(
			$request
		);
	}

	public function testLoginThrowBadRequestWhenPasswordIsEmpty(): void
	{
		$request = new LoginRequest(
			"rendy",
			null
		);

		$this->userRepository
			->expects($this->never())
			->method("selectById");

		$this->expectException(
			BadRequestException::class
		);

		$this->service->login(
			$request
		);
	}

	public function testLoginThrowBadRequestWhenUsernameAndPasswordAreEmpty(): void
	{
		$request = new LoginRequest(
			null,
			null
		);

		$this->userRepository
			->expects($this->never())
			->method("selectById");

		$this->expectException(
			BadRequestException::class
		);

		$this->service->login(
			$request
		);
	}

	public function testLoginThrowUnauthorizedWhenUserNotFound(): void
	{
		$this->userRepository
			->expects($this->once())
			->method("selectById")
			->with("rendy")
			->willReturn(null);

		$request = new LoginRequest(
			"rendy",
			"secret"
		);

		$this->expectException(
			UnauthorizedException::class
		);

		$this->expectExceptionMessage(
			"Pengguna tidak ditemukan"
		);

		$this->service->login(
			$request
		);
	}

	public function testLoginThrowUnauthorizedWhenPasswordIsWrong(): void
	{
		$user = (new UserEntity())
			->setId("user-001")
			->setNama("Rendy")
			->setPassword(
				password_hash(
					"correct-password",
					PASSWORD_BCRYPT
				)
			)
			->setIsDeleted(false);

		$this->userRepository
			->expects($this->once())
			->method("selectById")
			->with("rendy")
			->willReturn($user);

		$request = new LoginRequest(
			"rendy",
			"wrong-password"
		);

		$this->expectException(
			UnauthorizedException::class
		);

		$this->expectExceptionMessage(
			"Pengguna tidak ditemukan"
		);

		$this->service->login(
			$request
		);
	}
}