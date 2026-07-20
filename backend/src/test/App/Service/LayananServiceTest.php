<?php

declare(strict_types=1);

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Service;

use PHPUnit\Framework\TestCase;
use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\LayananEntity;
use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\UserEntity;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\BadRequestException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\NotFoundException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Repository\LayananRepository;
use RendyRobbani\Klinik\Kesjas\NTB\App\Repository\UserRepository;
use RendyRobbani\Klinik\Kesjas\NTB\App\Request\LayananRequest;

class LayananServiceTest extends TestCase
{
	private \PDO $connection;

	private UserRepository $userRepository;

	private LayananRepository $layananRepository;

	private LayananServiceImpl $service;

	protected function setUp(): void
	{
		$this->connection = $this->createMock(\PDO::class);

		$this->userRepository = $this->createMock(UserRepository::class);

		$this->layananRepository = $this->createMock(LayananRepository::class);

		$this->service = new LayananServiceImpl(
			$this->connection,
			$this->userRepository,
			$this->layananRepository
		);
	}

	private function createEntity(): LayananEntity
	{
		return (new LayananEntity())
			->setId(1)
			->setNomor(1)
			->setTanggal("2026-01-01")
			->setNomorSurat("001")
			->setTanggalSurat("2026-01-01")
			->setKomunitas("Komunitas")
			->setNama("Budi")
			->setJenis(1)
			->setUmur(30)
			->setPekerjaan("Petani")
			->setAlamat("Mataram")
			->setTelepon("08123456789")
			->setIsPelayanan(false)
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
			->setPermasalahan("Masalah")
			->setSolusi("Solusi")
			->setIdPetugas("123")
			->setCreatedAt("2026-01-01 10:00:00")
			->setCreatedBy("admin")
			->setUpdatedAt("2026-01-01 10:00:00")
			->setUpdatedBy("admin")
			->setIsDeleted(false)
			->setDeletedAt(null)
			->setDeletedBy(null);
	}

	private function createValidRequest(): LayananRequest
	{
		$request = $this->createMock(LayananRequest::class);

		$request->method("validate")
			->willReturn([]);

		$request->method("getTanggal")
			->willReturn("2026-01-01");

		$request->method("getNomorSurat")
			->willReturn("001");

		$request->method("getTanggalSurat")
			->willReturn("2026-01-01");

		$request->method("getKomunitas")
			->willReturn("Komunitas");

		$request->method("getNama")
			->willReturn("Budi");

		$request->method("getJenis")
			->willReturn(1);

		$request->method("getUmur")
			->willReturn(30);

		$request->method("getPekerjaan")
			->willReturn("Petani");

		$request->method("getAlamat")
			->willReturn("Mataram");

		$request->method("getTelepon")
			->willReturn("08123456789");

		$request->method("getPermasalahan")
			->willReturn("Masalah");

		$request->method("getSolusi")
			->willReturn("Solusi");

		$request->method("getIdPetugas")
			->willReturn("123");

		return $request;
	}

	public function testSelectAll(): void
	{
		$entity = $this->createEntity();

		$this->layananRepository
			->expects($this->once())
			->method("selectAll")
			->willReturn([$entity]);

		$result = $this->service->selectAll();

		$this->assertCount(1, $result);
		$this->assertSame(1, $result[0]->id);
		$this->assertSame("Budi", $result[0]->nama);
	}

	public function testSelectAllEmpty(): void
	{
		$this->layananRepository
			->expects($this->once())
			->method("selectAll")
			->willReturn([]);

		$result = $this->service->selectAll();

		$this->assertCount(0, $result);
	}

	public function testSelectByIdSuccess(): void
	{
		$entity = $this->createEntity();

		$this->layananRepository
			->expects($this->once())
			->method("selectById")
			->with(1)
			->willReturn($entity);

		$result = $this->service->selectById(1);

		$this->assertSame(1, $result->id);
		$this->assertSame("Budi", $result->nama);
	}

	public function testSelectByIdNotFound(): void
	{
		$this->layananRepository
			->expects($this->once())
			->method("selectById")
			->with(1)
			->willReturn(null);

		$this->expectException(NotFoundException::class);

		$this->service->selectById(1);
	}

	public function testCreateValidationFailed(): void
	{
		$request = $this->createMock(LayananRequest::class);

		$request
			->expects($this->once())
			->method("validate")
			->willReturn([
				"Nama" => [
					"tidak boleh kosong"
				]
			]);

		$this->expectException(BadRequestException::class);

		$this->service->create($request);
	}

	public function testCreatePetugasNotFound(): void
	{
		$request = $this->createValidRequest();

		$this->userRepository
			->expects($this->once())
			->method("selectById")
			->with("123")
			->willReturn(null);

		$this->expectException(BadRequestException::class);

		$this->service->create($request);
	}

	public function testCreateSuccess(): void
	{
		$request = $this->createValidRequest();

		$user = new UserEntity();

		$this->userRepository
			->expects($this->once())
			->method("selectById")
			->with("123")
			->willReturn($user);

		$this->layananRepository
			->expects($this->once())
			->method("selectAll")
			->willReturn([]);

		$this->layananRepository
			->expects($this->once())
			->method("save")
			->willReturnCallback(function (LayananEntity $entity) {
				$entity->setId(1);

				return $entity;
			});

		$this->connection
			->expects($this->once())
			->method("beginTransaction");

		$this->connection
			->expects($this->once())
			->method("commit");

		$result = $this->service->create($request);

		$this->assertSame(1, $result->id);

		$this->assertSame(
			"Budi",
			$result->nama
		);
	}

	public function testCreateRollbackWhenRepositoryFailed(): void
	{
		$request = $this->createValidRequest();

		$this->userRepository
			->method("selectById")
			->willReturn(new UserEntity());

		$this->layananRepository
			->method("selectAll")
			->willReturn([]);

		$this->layananRepository
			->method("save")
			->willThrowException(
				new \Exception("Database error")
			);

		$this->connection
			->expects($this->once())
			->method("beginTransaction");

		$this->connection
			->expects($this->once())
			->method("rollBack");

		$this->expectException(\Exception::class);

		$this->service->create($request);
	}

	public function testUpdateNotFound(): void
	{
		$request = $this->createValidRequest();

		$this->layananRepository
			->expects($this->once())
			->method("selectById")
			->with(1)
			->willReturn(null);

		$this->expectException(NotFoundException::class);

		$this->service->update($request, 1);
	}

	public function testUpdateDeletedData(): void
	{
		$request = $this->createValidRequest();

		$entity = $this->createEntity()
			->setIsDeleted(true);

		$this->layananRepository
			->expects($this->once())
			->method("selectById")
			->with(1)
			->willReturn($entity);

		$this->expectException(NotFoundException::class);

		$this->service->update($request, 1);
	}

	public function testUpdateValidationFailed(): void
	{
		$request = $this->createMock(LayananRequest::class);

		$entity = $this->createEntity();

		$this->layananRepository
			->method("selectById")
			->willReturn($entity);

		$request
			->expects($this->once())
			->method("validate")
			->willReturn([
				"Nama" => [
					"tidak boleh kosong"
				]
			]);

		$this->expectException(BadRequestException::class);

		$this->service->update($request, 1);
	}

	public function testUpdatePetugasNotFound(): void
	{
		$request = $this->createValidRequest();

		$entity = $this->createEntity();

		$this->layananRepository
			->method("selectById")
			->willReturn($entity);

		$this->userRepository
			->expects($this->once())
			->method("selectById")
			->with("123")
			->willReturn(null);

		$this->expectException(BadRequestException::class);

		$this->service->update($request, 1);
	}

	public function testUpdateSuccess(): void
	{
		$request = $this->createValidRequest();

		$entity = $this->createEntity();

		$this->layananRepository
			->expects($this->once())
			->method("selectById")
			->with(1)
			->willReturn($entity);

		$this->userRepository
			->expects($this->once())
			->method("selectById")
			->with("123")
			->willReturn(new UserEntity());

		$this->layananRepository
			->expects($this->once())
			->method("save")
			->willReturnCallback(
				function (LayananEntity $entity) {
					return $entity;
				}
			);

		$this->connection
			->expects($this->once())
			->method("beginTransaction");

		$this->connection
			->expects($this->once())
			->method("commit");

		$result = $this->service->update(
			$request,
			1
		);

		$this->assertSame(
			1,
			$result->id
		);

		$this->assertSame(
			"Budi",
			$result->nama
		);
	}

	public function testUpdateRollbackWhenSaveFailed(): void
	{
		$request = $this->createValidRequest();

		$entity = $this->createEntity();

		$this->layananRepository
			->method("selectById")
			->willReturn($entity);

		$this->userRepository
			->method("selectById")
			->willReturn(new UserEntity());

		$this->layananRepository
			->method("save")
			->willThrowException(
				new \Exception("Save error")
			);

		$this->connection
			->expects($this->once())
			->method("beginTransaction");

		$this->connection
			->expects($this->once())
			->method("rollBack");

		$this->expectException(\Exception::class);

		$this->service->update(
			$request,
			1
		);
	}

	public function testDeleteByIdNotFound(): void
	{
		$this->layananRepository
			->expects($this->once())
			->method("selectById")
			->with(1)
			->willReturn(null);

		$this->expectException(NotFoundException::class);

		$this->service->deleteById(1);
	}

	public function testDeleteByIdSuccess(): void
	{
		$entity = $this->createEntity();

		$this->layananRepository
			->expects($this->once())
			->method("selectById")
			->with(1)
			->willReturn($entity);

		$result = $this->service->deleteById(1);

		$this->assertSame(
			1,
			$result->id
		);

		$this->assertTrue(
			$result->isDeleted
		);

		$this->assertNotNull(
			$result->deletedAt
		);
	}

	public function testDeleteByIdAlreadyDeletedData(): void
	{
		$entity = $this->createEntity()
			->setIsDeleted(true)
			->setDeletedAt("2026-01-01 10:00:00")
			->setDeletedBy("admin");

		$this->layananRepository
			->expects($this->once())
			->method("selectById")
			->with(1)
			->willReturn($entity);

		$result = $this->service->deleteById(1);

		$this->assertTrue(
			$result->isDeleted
		);

		$this->assertSame(
			"2026-01-01 10:00:00",
			$result->deletedAt
		);
	}
}