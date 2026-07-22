<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Service;

use RendyRobbani\Klinik\Kesjas\NTB\App\Config\ApplicationConfig;
use RendyRobbani\Klinik\Kesjas\NTB\App\Context\ApplicationContext;
use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\LayananEntity;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\BadRequestException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Exception\NotFoundException;
use RendyRobbani\Klinik\Kesjas\NTB\App\Repository\LayananRepository;
use RendyRobbani\Klinik\Kesjas\NTB\App\Request\LayananRequest;
use RendyRobbani\Klinik\Kesjas\NTB\App\Response\LayananResponse;

class LayananServiceImpl implements LayananService
{
	private \PDO $connection;

	private LayananRepository $layananRepository;

	/**
	 * @param \PDO $connection
	 * @param LayananRepository $layananRepository
	 */
	public function __construct(\PDO $connection, LayananRepository $layananRepository)
	{
		$this->connection = $connection;
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

		if (!file_exists(ApplicationConfig::directory())) mkdir(ApplicationConfig::directory(), 0777, true);
		$fileName = implode("-", ["dokumentasi", date_format(new \DateTimeImmutable(), "Ymd-His")]) . "." . $request->getDokumentasiExt();
		move_uploaded_file($request->getDokumentasi()["tmp_name"], ApplicationConfig::directory() . DIRECTORY_SEPARATOR . $fileName);

		try {
			$this->connection->beginTransaction();

			$actionAt = date_format(new \DateTimeImmutable(), "Y-m-d H:i:s");
			$actionBy = ApplicationContext::getIdUser();

			$entity = new LayananEntity();
			$entity->setNomor(sizeof(array_filter($this->layananRepository->selectAll(), fn($entity) => $entity->getTanggal() != null && substr($entity->getTanggal(), 0, 10) == substr($request->getTanggal(), 0, 10))) + 1);
			$entity->setTanggal($request->getTanggal());
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
			$entity->setIdPetugas($actionBy);
			$entity->setCreatedAt($actionAt);
			$entity->setCreatedBy($actionBy);
			$entity->setUpdatedAt($actionAt);
			$entity->setUpdatedBy($actionBy);
			$entity->setIsDeleted(false);
			$entity->setDeletedAt(null);
			$entity->setDeletedBy(null);
			$entity->setDokumentasi($fileName);

			$entity = $this->layananRepository->save($entity);

			$this->connection->commit();

			return LayananResponse::fromEntity($this->layananRepository->selectById($entity->getId()));
		} catch (\Throwable $exception) {
			$this->connection->rollBack();
			unlink(ApplicationConfig::directory() . DIRECTORY_SEPARATOR . $fileName);
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

		if (!file_exists(ApplicationConfig::directory())) mkdir(ApplicationConfig::directory(), 0777, true);
		$fileName = implode("-", ["dokumentasi", date_format(new \DateTimeImmutable(), "Ymd-His")]) . "." . $request->getDokumentasiExt();
		move_uploaded_file($request->getDokumentasi()["tmp_name"], ApplicationConfig::directory() . DIRECTORY_SEPARATOR . $fileName);

		try {
			$this->connection->beginTransaction();

			$actionAt = date_format(new \DateTimeImmutable(), "Y-m-d H:i:s");
			$actionBy = ApplicationContext::getIdUser();

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
			$entity->setCreatedAt($actionAt);
			$entity->setCreatedBy($actionBy);
			$entity->setUpdatedAt($actionAt);
			$entity->setUpdatedBy($actionBy);
			$entity->setIsDeleted(false);
			$entity->setDeletedAt(null);
			$entity->setDeletedBy(null);
			$entity->setDokumentasi($fileName);

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