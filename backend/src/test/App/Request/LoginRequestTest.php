<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Request;

use PHPUnit\Framework\TestCase;

class LoginRequestTest extends TestCase
{
	public function testGetUsernameAndPassword(): void
	{
		$request = new LoginRequest(
			"rendy",
			"secret"
		);

		$this->assertSame(
			"rendy",
			$request->getUsername()
		);

		$this->assertSame(
			"secret",
			$request->getPassword()
		);
	}


	public function testValidateReturnEmptyArrayWhenDataIsValid(): void
	{
		$request = new LoginRequest(
			"rendy",
			"secret"
		);

		$this->assertSame(
			[],
			$request->validate()
		);
	}


	public function testValidateUsernameRequired(): void
	{
		$request = new LoginRequest(
			null,
			"secret"
		);

		$this->assertSame(
			[
				"username" => [
					"tidak boleh kosong"
				]
			],
			$request->validate()
		);
	}


	public function testValidatePasswordRequired(): void
	{
		$request = new LoginRequest(
			"rendy",
			null
		);

		$this->assertSame(
			[
				"password" => [
					"tidak boleh kosong"
				]
			],
			$request->validate()
		);
	}


	public function testValidateUsernameAndPasswordRequired(): void
	{
		$request = new LoginRequest(
			null,
			null
		);

		$this->assertSame(
			[
				"username" => [
					"tidak boleh kosong"
				],
				"password" => [
					"tidak boleh kosong"
				]
			],
			$request->validate()
		);
	}


	public function testValidateUsernameEmptyString(): void
	{
		$request = new LoginRequest(
			"",
			"secret"
		);

		$this->assertSame(
			[
				"username" => [
					"tidak boleh kosong"
				]
			],
			$request->validate()
		);
	}


	public function testValidatePasswordEmptyString(): void
	{
		$request = new LoginRequest(
			"rendy",
			""
		);

		$this->assertSame(
			[
				"password" => [
					"tidak boleh kosong"
				]
			],
			$request->validate()
		);
	}


	public function testValidateWhitespaceUsername(): void
	{
		$request = new LoginRequest(
			"   ",
			"secret"
		);

		$this->assertSame(
			[
				"username" => [
					"tidak boleh kosong"
				]
			],
			$request->validate()
		);
	}


	public function testValidateWhitespacePassword(): void
	{
		$request = new LoginRequest(
			"rendy",
			"   "
		);

		$this->assertSame(
			[
				"password" => [
					"tidak boleh kosong"
				]
			],
			$request->validate()
		);
	}
}