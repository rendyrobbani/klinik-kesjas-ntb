<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Config;

class ApplicationConfig
{
	/**
	 * @var DatabaseConfig
	 */
	private DatabaseConfig $database;

	/**
	 * @var SecurityConfig
	 */
	private SecurityConfig $security;

	private string $directory;

	private function __construct()
	{
	}

	/**
	 * @var ApplicationConfig|null
	 */
	private static null|ApplicationConfig $instance = null;

	/**
	 * @return ApplicationConfig
	 * @throws \Exception
	 */
	private static function instance(): ApplicationConfig
	{
		if (self::$instance == null) {
			$filename = __DIR__ . "/../../../../resources/application.json";
			if (!file_exists($filename)) throw new \Exception("Configuration file not found");

			$filesize = filesize($filename);
			if ($filesize <= 0) throw new \Exception("Configuration file is empty");

			$resource = fopen($filename, "r");
			$contents = json_decode(fread($resource, $filesize));
			if (json_last_error() !== JSON_ERROR_NONE || !is_object($contents)) throw new \Exception("Configuration file is invalid");
			fclose($resource);

			self::$instance = new ApplicationConfig();

			if (!isset($contents->database)) throw new \Exception("Configuration file is invalid");
			self::$instance->database = new DatabaseConfig($contents->database->url, $contents->database->username, $contents->database->password);

			if (!isset($contents->security)) throw new \Exception("Configuration file is invalid");
			self::$instance->security = new SecurityConfig($contents->security->secretKey, $contents->security->expired);

			if (!isset($contents->directory)) throw new \Exception("Configuration file is invalid");
			self::$instance->directory = $contents->directory;
		}
		return self::$instance;
	}

	/**
	 * @return DatabaseConfig
	 * @throws \Exception
	 */
	public static function database(): DatabaseConfig
	{
		return self::instance()->database;
	}

	/**
	 * @return SecurityConfig
	 * @throws \Exception
	 */
	public static function security(): SecurityConfig
	{
		return self::instance()->security;
	}

	/**
	 * @return string
	 * @throws \Exception
	 */
	public static function directory(): string
	{
		return self::instance()->directory;
	}
}