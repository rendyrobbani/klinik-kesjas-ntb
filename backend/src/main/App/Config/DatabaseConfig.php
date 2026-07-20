<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Config;

readonly class DatabaseConfig
{
	/**
	 * @param string $url
	 * @param string $username
	 * @param string $password
	 */
	public function __construct(string $url, string $username, string $password)
	{
		$this->url = $url;
		$this->username = $username;
		$this->password = $password;
	}

	/**
	 * @var string
	 */
	private string $url;

	/**
	 * @var string
	 */
	private string $username;

	/**
	 * @var string
	 */
	private string $password;

	/**
	 * @return string
	 */
	public function url(): string
	{
		return $this->url;
	}

	/**
	 * @return string
	 */
	public function username(): string
	{
		return $this->username;
	}

	/**
	 * @return string
	 */
	public function password(): string
	{
		return $this->password;
	}
}