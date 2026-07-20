<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Config;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ApplicationConfigTest extends TestCase
{
	private string $configFile;

	protected function setUp(): void
	{
		parent::setUp();
		$this->configFile = __DIR__ . "/../../../../config/application.json";
		if (!is_dir(dirname($this->configFile))) mkdir(dirname($this->configFile), 0777, true);
		$this->resetSingleton();
	}

	protected function tearDown(): void
	{
		if (file_exists($this->configFile)) unlink($this->configFile);
		$this->resetSingleton();
		parent::tearDown();
	}

	private function resetSingleton(): void
	{
		$reflection = new ReflectionClass(ApplicationConfig::class);
		$property = $reflection->getProperty("instance");
		$property->setValue(null);
	}

	/**
	 * @return void
	 * @throws \Exception
	 */
	public function testDatabaseReturnsDatabaseConfig(): void
	{
		file_put_contents(
			$this->configFile,
			json_encode([
				"database" => [
					"url" => "mysql:host=localhost;dbname=test",
					"username" => "root",
					"password" => "secret",
				],
			])
		);

		$database = ApplicationConfig::database();

		$this->assertInstanceOf(DatabaseConfig::class, $database);
	}

	/**
	 * @return void
	 * @throws \Exception
	 */
	public function testDatabaseReturnsSingletonInstance(): void
	{
		file_put_contents(
			$this->configFile,
			json_encode([
				"database" => [
					"url" => "mysql:host=localhost;dbname=test",
					"username" => "root",
					"password" => "secret",
				],
			])
		);

		$database1 = ApplicationConfig::database();
		$database2 = ApplicationConfig::database();

		$this->assertSame($database1, $database2);
	}

	/**
	 * @return void
	 * @throws \Exception
	 */
	public function testThrowsExceptionWhenConfigurationFileNotFound(): void
	{
		if (file_exists($this->configFile)) unlink($this->configFile);

		$this->expectException(\Exception::class);
		$this->expectExceptionMessageMatches("/^Configuration file not found$/");

		ApplicationConfig::database();
	}

	/**
	 * @return void
	 * @throws \Exception
	 */
	public function testThrowsExceptionWhenConfigurationFileIsEmpty(): void
	{
		file_put_contents($this->configFile, "");

		$this->expectException(\Exception::class);
		$this->expectExceptionMessageMatches("/^Configuration file is empty$/");

		ApplicationConfig::database();
	}

	/**
	 * @return void
	 * @throws \Exception
	 */
	public function testThrowsExceptionWhenConfigurationFileIsInvalid(): void
	{
		file_put_contents($this->configFile, "{}");

		$this->expectException(\Exception::class);
		$this->expectExceptionMessageMatches("/^Configuration file is invalid$/");

		ApplicationConfig::database();
	}

	/**
	 * @return void
	 * @throws \Exception
	 */
	public function testThrowsExceptionWhenJsonIsMalformed(): void
	{
		file_put_contents($this->configFile, "{");
		$this->expectException(\Exception::class);
		ApplicationConfig::database();
	}
}