<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Repository;

use PHPUnit\Framework\TestCase;
use RendyRobbani\Klinik\Kesjas\NTB\App\Connection\Connection;
use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\LayananEntity;

class LayananRepositoryTest extends TestCase
{
	private \PDO $connection;

	private LayananRepository $repository;

	protected function setUp(): void
	{
		$this->connection = Connection::instance();
		$this->repository = new LayananRepositoryImpl($this->connection);
	}

	protected function tearDown(): void
	{
		$this->connection->exec("delete from layanan where true");
		$this->connection->exec("alter table layanan auto_increment = 0");
	}

	public function testSaveInsert(): void
	{
		$entity = (new LayananEntity())
			->setNomor(1)
			->setTanggal("2025-01-01")
			->setNama("Budi")
			->setJenis(1)
			->setUmur(30)
			->setIsPelayanan(true)
			->setIsIdeologi(false)
			->setIsPolitik(false)
			->setIsSosial(false)
			->setIsBudaya(false)
			->setIsAgama(false)
			->setIsKamtibmas(false)
			->setIsKriminalitas(false)
			->setIsTibcarLantas(false)
			->setIsPrilakuPolri(false)
			->setIsYanPolri(false)
			->setIsLainLain(false)
			->setIsDeleted(false);

		$saved = $this->repository->save($entity);

		$this->assertNotNull($saved->getId());
	}

	public function testSelectById(): void
	{
		$entity = (new LayananEntity())
			->setNomor(1)
			->setTanggal("2025-01-01")
			->setNama("Budi")
			->setJenis(1)
			->setUmur(30)
			->setIsPelayanan(true)
			->setIsIdeologi(false)
			->setIsPolitik(false)
			->setIsSosial(false)
			->setIsBudaya(false)
			->setIsAgama(false)
			->setIsKamtibmas(false)
			->setIsKriminalitas(false)
			->setIsTibcarLantas(false)
			->setIsPrilakuPolri(false)
			->setIsYanPolri(false)
			->setIsLainLain(false)
			->setIsDeleted(false);

		$saved = $this->repository->save($entity);

		$result = $this->repository->selectById((string)$saved->getId());

		$this->assertNotNull($result);
		$this->assertSame("Budi", $result->getNama());
	}

	public function testSelectAll(): void
	{
		$this->testSaveInsert();

		$list = $this->repository->selectAll();

		$this->assertCount(1, $list);
	}

	public function testDeleteById(): void
	{
		$entity = new LayananEntity();
		$entity
			->setNomor(1)
			->setTanggal("2025-01-01")
			->setNama("Budi")
			->setJenis(1)
			->setUmur(30)
			->setIsPelayanan(true)
			->setIsIdeologi(false)
			->setIsPolitik(false)
			->setIsSosial(false)
			->setIsBudaya(false)
			->setIsAgama(false)
			->setIsKamtibmas(false)
			->setIsKriminalitas(false)
			->setIsTibcarLantas(false)
			->setIsPrilakuPolri(false)
			->setIsYanPolri(false)
			->setIsLainLain(false)
			->setIsDeleted(false);

		$saved = $this->repository->save($entity);

		$this->repository->deleteById(
			"2025-01-01 10:00:00",
			"00000000",
			(string)$saved->getId()
		);

		$deleted = $this->repository->selectById((string)$saved->getId());

		$this->assertTrue($deleted->getIsDeleted());
		$this->assertSame("00000000", $deleted->getDeletedBy());
	}

	public function testDeleteAll(): void
	{
		$this->testSaveInsert();

		$this->repository->deleteAll(
			"2025-01-01 10:00:00",
			"00000000"
		);

		foreach ($this->repository->selectAll() as $item) {
			$this->assertTrue($item->getIsDeleted());
		}
	}
}