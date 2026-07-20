<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Response;

use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\LayananEntity;

readonly class LayananResponse
{
	/**
	 * @var int|null
	 */
	public int|null $id;

	/**
	 * @var int|null
	 */
	public int|null $nomor;

	/**
	 * @var string|null
	 */
	public string|null $tanggal;

	/**
	 * @var string|null
	 */
	public string|null $nomorSurat;

	/**
	 * @var string|null
	 */
	public string|null $tanggalSurat;

	/**
	 * @var string|null
	 */
	public string|null $komunitas;

	/**
	 * @var string|null
	 */
	public string|null $nama;

	/**
	 * @var int|null
	 */
	public int|null $jenis;

	/**
	 * @var int|null
	 */
	public int|null $umur;

	/**
	 * @var string|null
	 */
	public string|null $pekerjaan;

	/**
	 * @var string|null
	 */
	public string|null $alamat;

	/**
	 * @var string|null
	 */
	public string|null $telepon;

	/**
	 * @var bool
	 */
	public bool $isPelayanan;

	/**
	 * @var bool
	 */
	public bool $isIdeologi;

	/**
	 * @var bool
	 */
	public bool $isPolitik;

	/**
	 * @var bool
	 */
	public bool $isSosial;

	/**
	 * @var bool
	 */
	public bool $isBudaya;

	/**
	 * @var bool
	 */
	public bool $isAgama;

	/**
	 * @var bool
	 */
	public bool $isKamtibmas;

	/**
	 * @var bool
	 */
	public bool $isKriminalitas;

	/**
	 * @var bool
	 */
	public bool $isTibcarLantas;

	/**
	 * @var bool
	 */
	public bool $isPrilakuPolri;

	/**
	 * @var bool
	 */
	public bool $isYanPolri;

	/**
	 * @var bool
	 */
	public bool $isLainLain;

	/**
	 * @var string|null
	 */
	public string|null $permasalahan;

	/**
	 * @var string|null
	 */
	public string|null $solusi;

	/**
	 * @var string|null
	 */
	public string|null $idPetugas;

	/**
	 * @var string|null
	 */
	public string|null $createdAt;

	/**
	 * @var string|null
	 */
	public string|null $createdBy;

	/**
	 * @var string|null
	 */
	public string|null $updatedAt;

	/**
	 * @var string|null
	 */
	public string|null $updatedBy;

	/**
	 * @var bool
	 */
	public bool $isDeleted;

	/**
	 * @var string|null
	 */
	public string|null $deletedAt;

	/**
	 * @var string|null
	 */
	public string|null $deletedBy;

	private function __construct()
	{
	}

	public static function fromEntity(LayananEntity $entity): self
	{
		$response = new self();
		$response->id = $entity->getId();
		$response->nomor = $entity->getNomor();
		$response->tanggal = $entity->getTanggal();
		$response->nomorSurat = $entity->getNomorSurat();
		$response->tanggalSurat = $entity->getTanggalSurat();
		$response->komunitas = $entity->getKomunitas();
		$response->nama = $entity->getNama();
		$response->jenis = $entity->getJenis();
		$response->umur = $entity->getUmur();
		$response->pekerjaan = $entity->getPekerjaan();
		$response->alamat = $entity->getAlamat();
		$response->telepon = $entity->getTelepon();
		$response->isPelayanan = $entity->getIsPelayanan();
		$response->isIdeologi = $entity->getIsIdeologi();
		$response->isPolitik = $entity->getIsPolitik();
		$response->isSosial = $entity->getIsSosial();
		$response->isBudaya = $entity->getIsBudaya();
		$response->isAgama = $entity->getIsAgama();
		$response->isKamtibmas = $entity->getIsKamtibmas();
		$response->isKriminalitas = $entity->getIsKriminalitas();
		$response->isTibcarLantas = $entity->getIsTibcarLantas();
		$response->isPrilakuPolri = $entity->getIsPrilakuPolri();
		$response->isYanPolri = $entity->getIsYanPolri();
		$response->isLainLain = $entity->getIsLainLain();
		$response->permasalahan = $entity->getPermasalahan();
		$response->solusi = $entity->getSolusi();
		$response->idPetugas = $entity->getIdPetugas();
		$response->createdAt = $entity->getCreatedAt();
		$response->createdBy = $entity->getCreatedBy();
		$response->updatedAt = $entity->getUpdatedAt();
		$response->updatedBy = $entity->getUpdatedBy();
		$response->isDeleted = $entity->getIsDeleted();
		$response->deletedAt = $entity->getDeletedAt();
		$response->deletedBy = $entity->getDeletedBy();
		return $response;
	}
}