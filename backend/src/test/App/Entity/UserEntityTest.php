<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Entity;

use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
	public function testSetAndGetId(): void
	{
		$entity = new UserEntity();

		$result = $entity->setId("user-001");

		$this->assertSame($entity, $result);
		$this->assertSame("user-001", $entity->getId());
	}

	public function testSetAndGetNama(): void
	{
		$entity = new UserEntity();

		$result = $entity->setNama("Rendy");

		$this->assertSame($entity, $result);
		$this->assertSame("Rendy", $entity->getNama());
	}

	public function testSetAndGetPassword(): void
	{
		$entity = new UserEntity();

		$result = $entity->setPassword("secret");

		$this->assertSame($entity, $result);
		$this->assertSame("secret", $entity->getPassword());
	}

	public function testSetAndGetCreatedAt(): void
	{
		$entity = new UserEntity();

		$entity->setCreatedAt("2026-01-01 10:00:00");

		$this->assertSame(
			"2026-01-01 10:00:00",
			$entity->getCreatedAt()
		);
	}

	public function testCreatedAtCanBeNull(): void
	{
		$entity = new UserEntity();

		$result = $entity->setCreatedAt(null);

		$this->assertSame($entity, $result);
		$this->assertNull($entity->getCreatedAt());
	}

	public function testSetAndGetCreatedBy(): void
	{
		$entity = new UserEntity();

		$entity->setCreatedBy("admin");

		$this->assertSame("admin", $entity->getCreatedBy());
	}

	public function testCreatedByCanBeNull(): void
	{
		$entity = new UserEntity();

		$entity->setCreatedBy(null);

		$this->assertNull($entity->getCreatedBy());
	}

	public function testSetAndGetUpdatedAt(): void
	{
		$entity = new UserEntity();

		$entity->setUpdatedAt("2026-01-02 10:00:00");

		$this->assertSame(
			"2026-01-02 10:00:00",
			$entity->getUpdatedAt()
		);
	}

	public function testUpdatedAtCanBeNull(): void
	{
		$entity = new UserEntity();

		$entity->setUpdatedAt(null);

		$this->assertNull($entity->getUpdatedAt());
	}

	public function testSetAndGetUpdatedBy(): void
	{
		$entity = new UserEntity();

		$entity->setUpdatedBy("operator");

		$this->assertSame("operator", $entity->getUpdatedBy());
	}

	public function testUpdatedByCanBeNull(): void
	{
		$entity = new UserEntity();

		$entity->setUpdatedBy(null);

		$this->assertNull($entity->getUpdatedBy());
	}

	public function testSetAndGetIsDeleted(): void
	{
		$entity = new UserEntity();

		$result = $entity->setIsDeleted(true);

		$this->assertSame($entity, $result);
		$this->assertTrue($entity->isDeleted());
	}

	public function testSetIsDeletedFalse(): void
	{
		$entity = new UserEntity();

		$entity->setIsDeleted(false);

		$this->assertFalse($entity->isDeleted());
	}

	public function testSetAndGetDeletedAt(): void
	{
		$entity = new UserEntity();

		$entity->setDeletedAt("2026-01-03 10:00:00");

		$this->assertSame(
			"2026-01-03 10:00:00",
			$entity->getDeletedAt()
		);
	}

	public function testDeletedAtCanBeNull(): void
	{
		$entity = new UserEntity();

		$entity->setDeletedAt(null);

		$this->assertNull($entity->getDeletedAt());
	}

	public function testSetAndGetDeletedBy(): void
	{
		$entity = new UserEntity();

		$entity->setDeletedBy("admin");

		$this->assertSame("admin", $entity->getDeletedBy());
	}

	public function testDeletedByCanBeNull(): void
	{
		$entity = new UserEntity();

		$entity->setDeletedBy(null);

		$this->assertNull($entity->getDeletedBy());
	}

	public function testCanUseFluentSetterChain(): void
	{
		$entity = (new UserEntity())
			->setId("user-001")
			->setNama("Rendy")
			->setPassword("secret")
			->setCreatedAt("2026-01-01")
			->setCreatedBy("system")
			->setUpdatedAt("2026-01-02")
			->setUpdatedBy("admin")
			->setIsDeleted(false)
			->setDeletedAt(null)
			->setDeletedBy(null);

		$this->assertSame("user-001", $entity->getId());
		$this->assertSame("Rendy", $entity->getNama());
		$this->assertSame("secret", $entity->getPassword());
		$this->assertSame("2026-01-01", $entity->getCreatedAt());
		$this->assertSame("system", $entity->getCreatedBy());
		$this->assertSame("2026-01-02", $entity->getUpdatedAt());
		$this->assertSame("admin", $entity->getUpdatedBy());
		$this->assertFalse($entity->isDeleted());
		$this->assertNull($entity->getDeletedAt());
		$this->assertNull($entity->getDeletedBy());
	}
}