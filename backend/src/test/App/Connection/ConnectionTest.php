<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Connection;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ConnectionTest extends TestCase
{
	protected function setUp(): void
	{
		$this->resetSingleton();
	}

	protected function tearDown(): void
	{
		$this->resetSingleton();
	}

	private function resetSingleton(): void
	{
		$reflection = new ReflectionClass(Connection::class);

		$property = $reflection->getProperty('instance');
		$property->setValue(null);
	}

	/**
	 * @return void
	 * @throws \Exception
	 */
	public function testInstanceReturnsPDO(): void
	{
		$connection = Connection::instance();

		$this->assertInstanceOf(\PDO::class, $connection);
	}

	/**
	 * @return void
	 * @throws \Exception
	 */
	public function testInstanceReturnsSingleton(): void
	{
		$connection1 = Connection::instance();
		$connection2 = Connection::instance();

		$this->assertSame($connection1, $connection2);
	}
}