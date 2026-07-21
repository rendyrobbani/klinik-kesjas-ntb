<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Service;

use RendyRobbani\Klinik\Kesjas\NTB\App\Context\ApplicationContext;
use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\LayananEntity;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\BadRequestException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\NotFoundException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Repository\LayananRepository;
use RendyRobbani\Klinik\Kesjas\NTB\App\Repository\UserRepository;
use RendyRobbani\Klinik\Kesjas\NTB\App\Request\LayananRequest;
use RendyRobbani\Klinik\Kesjas\NTB\App\Response\LayananResponse;

class LayananServiceImpl implements LayananService
{
	private \PDO $connection;

	private UserRepository $userRepository;

	private LayananRepository $layananRepository;

	/**
	 * @param \PDO $connection
	 * @param UserRepository $userRepository
	 * @param LayananRepository $layananRepository
	 */
	public function __construct(\PDO $connection, UserRepository $userRepository, LayananRepository $layananRepository)
	{
		$this->connection = $connection;
		$this->userRepository = $userRepository;
		$this->layananRepository = $layananRepository;
	}

	/**
	 * @inheritDoc
	 */
	function selectAll(): array
	{
		return array_map(fn($entity) => LayananResponse::fromEntity($entity), $this->layananRepository->selectByIsDeleted(false));
	}

	/**
	 * @inheritDoc
	 */
	function selectById(int $id): LayananResponse
	{
		$entity = $this->layananRepository->selectById($id);
		if ($entity == null) throw new NotFoundException();
		return LayananResponse::fromEntity($entity);
	}

	/**
	 * @inheritDoc
	 */
	function create(LayananRequest $request): LayananResponse
	{
		$errors = $request->validate();
		if (sizeof($errors) > 0) throw new BadRequestException($errors);

		$user = $this->userRepository->selectById($request->getIdPetugas());
		if ($user == null) throw new BadRequestException(["idPetugas" => ["tidak ditemukan"]]);

		try {
			$this->connection->beginTransaction();

			$actionAt = date_format(new \DateTimeImmutable(), "Y-m-d H:i:s");
			$actionBy = ApplicationContext::getIdUser();

			$entity = new LayananEntity();
			$entity->setNomor(sizeof(array_filter($this->layananRepository->selectAll(), fn($entity) => $entity->getTanggal() != null && substr($entity->getTanggal(), 0, 10) == substr($request->getTanggal(), 0, 10))) + 1);
			$entity->setTanggal($request->getTanggal());
			$entity->setNomorSurat($request->getNomorSurat());
			$entity->setTanggalSurat($request->getTanggalSurat());
			$entity->setKomunitas($request->getKomunitas());
			$entity->setNama($request->getNama());
			$entity->setJenis($request->getJenis());
			$entity->setUmur($request->getUmur());
			$entity->setPekerjaan($request->getPekerjaan());
			$entity->setAlamat($request->getAlamat());
			$entity->setTelepon($request->getTelepon());
			$entity->setIsPelayanan($request->getIsPelayanan());
			$entity->setIsIdeologi($request->getIsIdeologi());
			$entity->setIsPolitik($request->getIsPolitik());
			$entity->setIsSosial($request->getIsSosial());
			$entity->setIsBudaya($request->getIsBudaya());
			$entity->setIsAgama($request->getIsAgama());
			$entity->setIsKamtibmas($request->getIsKamtibmas());
			$entity->setIsKriminalitas($request->getIsKriminalitas());
			$entity->setIsTibcarLantas($request->getIsTibcarLantas());
			$entity->setIsPrilakuPolri($request->getIsPrilakuPolri());
			$entity->setIsYanPolri($request->getIsYanPolri());
			$entity->setIsLainLain($request->getIsLainLain());
			$entity->setPermasalahan($request->getPermasalahan());
			$entity->setSolusi($request->getSolusi());
			$entity->setIdPetugas($request->getIdPetugas());
			$entity->setCreatedAt($actionAt);
			$entity->setCreatedBy($actionBy);
			$entity->setUpdatedAt($actionAt);
			$entity->setUpdatedBy($actionBy);
			$entity->setIsDeleted(false);
			$entity->setDeletedAt(null);
			$entity->setDeletedBy(null);

			$entity = $this->layananRepository->save($entity);
			$this->connection->commit();

			return LayananResponse::fromEntity($entity);
		} catch (\Throwable $exception) {
			$this->connection->rollBack();
			throw $exception;
		}
	}

	/**
	 * @inheritDoc
	 */
	function update(LayananRequest $request, int $id): LayananResponse
	{
		$entity = $this->layananRepository->selectById($id);
		if ($entity == null || $entity->getIsDeleted()) throw new NotFoundException();

		$errors = $request->validate();
		if (sizeof($errors) > 0) throw new BadRequestException($errors);

		$user = $this->userRepository->selectById($request->getIdPetugas());
		if ($user == null) throw new BadRequestException(["idPetugas" => ["tidak ditemukan"]]);

		try {
			$this->connection->beginTransaction();

			$actionAt = date_format(new \DateTimeImmutable(), "Y-m-d H:i:s");
			$actionBy = ApplicationContext::getIdUser();

			$entity->setKomunitas($request->getKomunitas());
			$entity->setNama($request->getNama());
			$entity->setJenis($request->getJenis());
			$entity->setUmur($request->getUmur());
			$entity->setPekerjaan($request->getPekerjaan());
			$entity->setAlamat($request->getAlamat());
			$entity->setTelepon($request->getTelepon());
			$entity->setIsPelayanan($request->getIsPelayanan());
			$entity->setIsIdeologi($request->getIsIdeologi());
			$entity->setIsPolitik($request->getIsPolitik());
			$entity->setIsSosial($request->getIsSosial());
			$entity->setIsBudaya($request->getIsBudaya());
			$entity->setIsAgama($request->getIsAgama());
			$entity->setIsKamtibmas($request->getIsKamtibmas());
			$entity->setIsKriminalitas($request->getIsKriminalitas());
			$entity->setIsTibcarLantas($request->getIsTibcarLantas());
			$entity->setIsPrilakuPolri($request->getIsPrilakuPolri());
			$entity->setIsYanPolri($request->getIsYanPolri());
			$entity->setIsLainLain($request->getIsLainLain());
			$entity->setPermasalahan($request->getPermasalahan());
			$entity->setSolusi($request->getSolusi());
			$entity->setIdPetugas($request->getIdPetugas());
			$entity->setCreatedAt($actionAt);
			$entity->setCreatedBy($actionBy);
			$entity->setUpdatedAt($actionAt);
			$entity->setUpdatedBy($actionBy);
			$entity->setIsDeleted(false);
			$entity->setDeletedAt(null);
			$entity->setDeletedBy(null);

			$entity = $this->layananRepository->save($entity);
			$this->connection->commit();

			return LayananResponse::fromEntity($entity);
		} catch (\Throwable $exception) {
			$this->connection->rollBack();
			throw $exception;
		}
	}

	/**
	 * @inheritDoc
	 */
	function deleteById(int $id): LayananResponse
	{
		try {
			$this->connection->beginTransaction();

			$entity = $this->layananRepository->selectById($id);
			if ($entity == null) throw new NotFoundException();
			if (!$entity->getIsDeleted()) {
				$entity->setIsDeleted(true);
				$entity->setDeletedAt(date_format(new \DateTimeImmutable(), "Y-m-d H:i:s"));
				$entity->setDeletedBy(ApplicationContext::getIdUser());
				$this->layananRepository->save($entity);
			}

			$this->connection->commit();

			return LayananResponse::fromEntity($entity);
		} catch (\Throwable $exception) {
			$this->connection->rollBack();
			throw $exception;
		}
	}
}