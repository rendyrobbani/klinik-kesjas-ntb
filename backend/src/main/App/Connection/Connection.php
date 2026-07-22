<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Connection;

use RendyRobbani\Klinik\Kesjas\NTB\App\Config\ApplicationConfig;

class Connection
{
	/**
	 * @var \PDO|null
	 */
	private static \PDO|null $instance = null;

	private function __construct()
	{
	}

	/**
	 * @return \PDO
	 * @throws \Exception
	 */
	public static function instance(): \PDO
	{
		if (self::$instance == null) {
			$config = ApplicationConfig::database();
			self::$instance = new \PDO($config->url(), $config->username(), $config->password());
		}
		return self::$instance;
	}
}