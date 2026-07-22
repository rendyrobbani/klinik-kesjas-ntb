<?php

declare(strict_types=1);

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Service;

use PHPUnit\Framework\TestCase;
use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\LayananEntity;
use RendyRobbani\Klinik\Kesjas\NTB\App\Repository\LayananRepository;
use RendyRobbani\Klinik\Kesjas\NTB\App\Request\LayananRequest;

class LayananServiceTest extends TestCase
{
	private \PDO $connection;

	private LayananRepository $repository;

	private LayananServiceImpl $service;

	protected function setUp(): void
	{
		$this->connection = $this->createMock(\PDO::class);
		$this->repository = $this->createMock(LayananRepository::class);

		$this->service = new LayananServiceImpl(
			$this->connection,
			$this->repository
		);
	}

	private function createRequest(): LayananRequest
	{
		return (new LayananRequest())
			->setNomor(1)
			->setTanggal("2025-01-01 08:00:00")
			->setNama("Rendy")
			->setJenis(1)
			->setUmur(28)
			->setPekerjaan("Programmer")
			->setAlamat("Mataram")
			->setTelepon("08123456789")
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
			->setPermasalahan("Permasalahan")
			->setSolusi("Solusi");
	}

	private function createEntity(): LayananEntity
	{
		$entity = new LayananEntity();

		$entity->setId(1);
		$entity->setNomor(1);
		$entity->setTanggal("2025-01-01 08:00:00");
		$entity->setNama("Rendy");
		$entity->setIsDeleted(false);

		return $entity;
	}

	public function testSelectAllSuccess(): void
	{
		$entities = [
			$this->createEntity(),
			$this->createEntity()
		];

		$this->repository
			->expects($this->once())
			->method("selectByIsDeleted")
			->with(false)
			->willReturn($entities);

		$responses = $this->service->selectAll();

		$this->assertCount(2, $responses);
		$this->assertEquals("Rendy", $responses[0]->getNama());
		$this->assertEquals("Rendy", $responses[1]->getNama());
	}

	public function testSelectAllEmpty(): void
	{
		$this->repository
			->expects($this->once())
			->method("selectByIsDeleted")
			->with(false)
			->willReturn([]);

		$responses = $this->service->selectAll();

		$this->assertIsArray($responses);
		$this->assertCount(0, $responses);
	}

	public function testSelectByIdSuccess(): void
	{
		$entity = $this->createEntity();

		$this->repository
			->expects($this->once())
			->method("selectById")
			->with(1)
			->willReturn($entity);

		$response = $this->service->selectById(1);

		$this->assertEquals(1, $response->getId());
		$this->assertEquals("Rendy", $response->getNama());
		$this->assertEquals(1, $response->getNomor());
	}

	public function testSelectByIdNotFound(): void
	{
		$this->expectException(NotFoundException::class);

		$this->repository
			->expects($this->once())
			->method("selectById")
			->with(100)
			->willReturn(null);

		$this->service->selectById(100);
	}

	public function testCreateSuccess(): void
	{
		$request = $this->createRequest();

		$savedEntity = $this->createEntity();

		$this->connection
			->expects($this->once())
			->method("beginTransaction");

		$this->connection
			->expects($this->once())
			->method("commit");

		$this->connection
			->expects($this->never())
			->method("rollBack");

		$this->repository
			->expects($this->once())
			->method("selectAll")
			->willReturn([]);

		$this->repository
			->expects($this->once())
			->method("save")
			->with($this->isInstanceOf(LayananEntity::class))
			->willReturn($savedEntity);

		$response = $this->service->create($request);

		$this->assertNotNull($response);
		$this->assertEquals(1, $response->getId());
		$this->assertEquals("Rendy", $response->getNama());
	}

	public function testCreateValidationFailed(): void
	{
		$this->expectException(BadRequestException::class);

		$request = new LayananRequest();

		$this->repository
			->expects($this->never())
			->method("save");

		$this->connection
			->expects($this->never())
			->method("beginTransaction");

		$this->service->create($request);
	}

	public function testCreateRollbackWhenRepositoryThrowsException(): void
	{
		$this->expectException(\RuntimeException::class);

		$request = $this->createRequest();

		$this->connection
			->expects($this->once())
			->method("beginTransaction");

		$this->connection
			->expects($this->once())
			->method("rollBack");

		$this->connection
			->expects($this->never())
			->method("commit");

		$this->repository
			->expects($this->once())
			->method("selectAll")
			->willReturn([]);

		$this->repository
			->expects($this->once())
			->method("save")
			->willThrowException(new \RuntimeException("Database Error"));

		$this->service->create($request);
	}

	public function testCreateGenerateNextNomor(): void
	{
		$request = $this->createRequest();

		$old = $this->createEntity();
		$old->setTanggal("2025-01-01 09:00:00");

		$saved = $this->createEntity();
		$saved->setNomor(2);

		$this->connection
			->method("beginTransaction");

		$this->connection
			->method("commit");

		$this->repository
			->method("selectAll")
			->willReturn([$old]);

		$this->repository
			->expects($this->once())
			->method("save")
			->with($this->callback(function (LayananEntity $entity) {
				return $entity->getNomor() === 2;
			}))
			->willReturn($saved);

		$response = $this->service->create($request);

		$this->assertEquals(2, $response->getNomor());
	}
}