<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Repository;

use PHPUnit\Framework\TestCase;
use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\UserEntity;

class UserRepositoryTest extends TestCase
{
	private \PDO $connection;

	private UserRepositoryImpl $repository;

	protected function setUp(): void
	{
		$this->connection = $this->createMock(\PDO::class);

		$this->repository = new UserRepositoryImpl(
			$this->connection
		);
	}

	public function testSelectByIdReturnUserEntity(): void
	{
		$statement = $this->createMock(\PDOStatement::class);

		$this->connection
			->expects($this->once())
			->method("prepare")
			->with(
				"select * from user where id = :id"
			)
			->willReturn($statement);

		$statement
			->expects($this->once())
			->method("bindValue")
			->with(
				"id",
				"user-001"
			);

		$statement
			->expects($this->once())
			->method("execute");

		$statement
			->expects($this->once())
			->method("fetch")
			->with(\PDO::FETCH_NAMED)
			->willReturn([
				"id" => "user-001",
				"nama" => "Rendy",
				"password" => "secret"
			]);

		$result = $this->repository->selectById(
			"user-001"
		);

		$this->assertInstanceOf(
			UserEntity::class,
			$result
		);

		$this->assertSame(
			"user-001",
			$result->getId()
		);

		$this->assertSame(
			"Rendy",
			$result->getNama()
		);

		$this->assertSame(
			"secret",
			$result->getPassword()
		);
	}

	public function testSelectByIdReturnNullWhenNotFound(): void
	{
		$statement = $this->createMock(\PDOStatement::class);

		$this->connection
			->expects($this->once())
			->method("prepare")
			->willReturn($statement);

		$statement
			->expects($this->once())
			->method("execute");

		$statement
			->expects($this->once())
			->method("fetch")
			->willReturn(false);

		$result = $this->repository->selectById(
			"user-not-found"
		);

		$this->assertNull($result);
	}

	public function testSelectAllReturnArrayOfUserEntity(): void
	{
		$statement = $this->createMock(\PDOStatement::class);

		$this->connection
			->expects($this->once())
			->method("prepare")
			->with(
				"select * from user"
			)
			->willReturn($statement);

		$statement
			->expects($this->once())
			->method("execute");

		$statement
			->expects($this->once())
			->method("fetchAll")
			->with(\PDO::FETCH_NAMED)
			->willReturn([
				[
					"id" => "user-001",
					"nama" => "Rendy",
					"password" => "secret"
				],
				[
					"id" => "user-002",
					"nama" => "Budi",
					"password" => "password"
				]
			]);

		$result = $this->repository->selectAll();

		$this->assertCount(
			2,
			$result
		);

		$this->assertInstanceOf(
			UserEntity::class,
			$result[0]
		);

		$this->assertSame(
			"Rendy",
			$result[0]->getNama()
		);
	}

	public function testSaveReturnSameEntity(): void
	{
		$statement = $this->createMock(\PDOStatement::class);

		$this->connection
			->expects($this->once())
			->method("prepare")
			->willReturn($statement);

		$statement
			->expects($this->atLeastOnce())
			->method("bindValue");

		$statement
			->expects($this->once())
			->method("execute");

		$user = (new UserEntity())
			->setId("user-001")
			->setNama("Rendy")
			->setPassword("secret")
			->setCreatedAt("2026-01-01 10:00:00")
			->setCreatedBy("system")
			->setUpdatedAt("2026-01-01 10:00:00")
			->setUpdatedBy("system")
			->setIsDeleted(false)
			->setDeletedAt(null)
			->setDeletedBy(null);

		$result = $this->repository->save(
			$user
		);

		$this->assertSame(
			$user,
			$result
		);
	}

	public function testDeleteByIdExecuteSoftDelete(): void
	{
		$statement = $this->createMock(\PDOStatement::class);

		$this->connection
			->expects($this->once())
			->method("prepare")
			->with(
				$this->stringContains(
					"update user"
				)
			)
			->willReturn($statement);

		$statement
			->expects($this->exactly(3))
			->method("bindValue");

		$statement
			->expects($this->once())
			->method("execute");

		$this->repository->deleteById(
			"2026-01-01 10:00:00",
			"admin",
			"user-001"
		);
	}

	public function testDeleteAllExecuteSoftDelete(): void
	{
		$statement = $this->createMock(\PDOStatement::class);

		$this->connection
			->expects($this->once())
			->method("prepare")
			->with(
				$this->stringContains(
					"update user"
				)
			)
			->willReturn($statement);

		$statement
			->expects($this->exactly(2))
			->method("bindValue");

		$statement
			->expects($this->once())
			->method("execute");

		$this->repository->deleteAll(
			"2026-01-01 10:00:00",
			"admin"
		);
	}
}
