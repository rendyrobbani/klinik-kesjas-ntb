<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Config;

readonly class SecurityConfig
{
	/**
	 * @var string
	 */
	private string $secretKey;

	/**
	 * @var int
	 */
	private int $expiredTime;

	/**
	 * @param string $secretKey
	 * @param int $expiredTime
	 */
	public function __construct(string $secretKey, int $expiredTime)
	{
		$this->secretKey = $secretKey;
		$this->expiredTime = $expiredTime;
	}

	/**
	 * @return string
	 */
	public function secretKey(): string
	{
		return $this->secretKey;
	}

	/**
	 * @return int
	 */
	public function expiredTime(): int
	{
		return $this->expiredTime;
	}
}