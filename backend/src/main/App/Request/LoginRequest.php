<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Request;

readonly class LoginRequest
{
	private null|string $username;

	private null|string $password;

	public function __construct(null|string $username, null|string $password)
	{
		$this->username = $username;
		$this->password = $password;
	}

	public function validate(): array
	{
		$errors = [];
		if ($this->username == null || trim($this->username) == "") $errors["username"] = ["tidak boleh kosong"];
		if ($this->password == null || trim($this->password) == "") $errors["password"] = ["tidak boleh kosong"];
		return $errors;
	}

	public function getUsername(): null|string
	{
		return $this->username;
	}

	public function getPassword(): null|string
	{
		return $this->password;
	}
}