<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Entity;

class LayananEntity
{
	/**
	 * @var int|null
	 */
	private int|null $id;

	/**
	 * @var int|null
	 */
	private int|null $nomor;

	/**
	 * @var string|null
	 */
	private string|null $tanggal;

	/**
	 * @var string|null
	 */
	private string|null $nomorSurat;

	/**
	 * @var string|null
	 */
	private string|null $tanggalSurat;

	/**
	 * @var string|null
	 */
	private string|null $komunitas;

	/**
	 * @var string|null
	 */
	private string|null $nama;

	/**
	 * @var int|null
	 */
	private int|null $jenis;

	/**
	 * @var int|null
	 */
	private int|null $umur;

	/**
	 * @var string|null
	 */
	private string|null $pekerjaan;

	/**
	 * @var string|null
	 */
	private string|null $alamat;

	/**
	 * @var string|null
	 */
	private string|null $telepon;

	/**
	 * @var bool
	 */
	private bool $isPelayanan;

	/**
	 * @var bool
	 */
	private bool $isIdeologi;

	/**
	 * @var bool
	 */
	private bool $isPolitik;

	/**
	 * @var bool
	 */
	private bool $isSosial;

	/**
	 * @var bool
	 */
	private bool $isBudaya;

	/**
	 * @var bool
	 */
	private bool $isAgama;

	/**
	 * @var bool
	 */
	private bool $isKamtibmas;

	/**
	 * @var bool
	 */
	private bool $isKriminalitas;

	/**
	 * @var bool
	 */
	private bool $isTibcarLantas;

	/**
	 * @var bool
	 */
	private bool $isPrilakuPolri;

	/**
	 * @var bool
	 */
	private bool $isYanPolri;

	/**
	 * @var bool
	 */
	private bool $isLainLain;

	/**
	 * @var string|null
	 */
	private string|null $permasalahan;

	/**
	 * @var string|null
	 */
	private string|null $solusi;

	/**
	 * @var string|null
	 */
	private string|null $idPetugas;

	/**
	 * @var string|null
	 */
	private string|null $namaPetugas;

	/**
	 * @var string|null
	 */
	private string|null $createdAt;

	/**
	 * @var string|null
	 */
	private string|null $createdBy;

	/**
	 * @var string|null
	 */
	private string|null $updatedAt;

	/**
	 * @var string|null
	 */
	private string|null $updatedBy;

	/**
	 * @var bool
	 */
	private bool $isDeleted;

	/**
	 * @var string|null
	 */
	private string|null $deletedAt;

	/**
	 * @var string|null
	 */
	private string|null $deletedBy;

	/**
	 * @return int|null
	 */
	public function getId(): int|null
	{
		return $this->id ?? null;
	}

	/**
	 * @param int|null $id
	 * @return $this
	 */
	public function setId(int|null $id): LayananEntity
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getNomor(): int|null
	{
		return $this->nomor ?? null;
	}

	/**
	 * @param int|null $nomor
	 * @return $this
	 */
	public function setNomor(int|null $nomor): LayananEntity
	{
		$this->nomor = $nomor;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getTanggal(): string|null
	{
		return $this->tanggal ?? null;
	}

	/**
	 * @param string|null $tanggal
	 * @return $this
	 */
	public function setTanggal(string|null $tanggal): LayananEntity
	{
		$this->tanggal = $tanggal;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getNomorSurat(): string|null
	{
		return $this->nomorSurat ?? null;
	}

	/**
	 * @param string|null $nomorSurat
	 * @return $this
	 */
	public function setNomorSurat(string|null $nomorSurat): LayananEntity
	{
		$this->nomorSurat = $nomorSurat;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getTanggalSurat(): string|null
	{
		return $this->tanggalSurat ?? null;
	}

	/**
	 * @param string|null $tanggalSurat
	 * @return $this
	 */
	public function setTanggalSurat(string|null $tanggalSurat): LayananEntity
	{
		$this->tanggalSurat = $tanggalSurat;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getKomunitas(): string|null
	{
		return $this->komunitas ?? null;
	}

	/**
	 * @param string|null $komunitas
	 * @return $this
	 */
	public function setKomunitas(string|null $komunitas): LayananEntity
	{
		$this->komunitas = $komunitas;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getNama(): string|null
	{
		return $this->nama ?? null;
	}

	/**
	 * @param string|null $nama
	 * @return $this
	 */
	public function setNama(string|null $nama): LayananEntity
	{
		$this->nama = $nama;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getJenis(): int|null
	{
		return $this->jenis ?? null;
	}

	/**
	 * @param int|null $jenis
	 * @return $this
	 */
	public function setJenis(int|null $jenis): LayananEntity
	{
		$this->jenis = $jenis;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getUmur(): int|null
	{
		return $this->umur ?? null;
	}

	/**
	 * @param int|null $umur
	 * @return $this
	 */
	public function setUmur(int|null $umur): LayananEntity
	{
		$this->umur = $umur;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPekerjaan(): string|null
	{
		return $this->pekerjaan ?? null;
	}

	/**
	 * @param string|null $pekerjaan
	 * @return $this
	 */
	public function setPekerjaan(string|null $pekerjaan): LayananEntity
	{
		$this->pekerjaan = $pekerjaan;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getAlamat(): string|null
	{
		return $this->alamat ?? null;
	}

	/**
	 * @param string|null $alamat
	 * @return $this
	 */
	public function setAlamat(string|null $alamat): LayananEntity
	{
		$this->alamat = $alamat;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getTelepon(): string|null
	{
		return $this->telepon ?? null;
	}

	/**
	 * @param string|null $telepon
	 * @return $this
	 */
	public function setTelepon(string|null $telepon): LayananEntity
	{
		$this->telepon = $telepon;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsPelayanan(): bool
	{
		return $this->isPelayanan ?? false;
	}

	/**
	 * @param bool $isPelayanan
	 * @return $this
	 */
	public function setIsPelayanan(bool $isPelayanan): LayananEntity
	{
		$this->isPelayanan = $isPelayanan;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsIdeologi(): bool
	{
		return $this->isIdeologi ?? false;
	}

	/**
	 * @param bool $isIdeologi
	 * @return $this
	 */
	public function setIsIdeologi(bool $isIdeologi): LayananEntity
	{
		$this->isIdeologi = $isIdeologi;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsPolitik(): bool
	{
		return $this->isPolitik ?? false;
	}

	/**
	 * @param bool $isPolitik
	 * @return $this
	 */
	public function setIsPolitik(bool $isPolitik): LayananEntity
	{
		$this->isPolitik = $isPolitik;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsSosial(): bool
	{
		return $this->isSosial ?? false;
	}

	/**
	 * @param bool $isSosial
	 * @return $this
	 */
	public function setIsSosial(bool $isSosial): LayananEntity
	{
		$this->isSosial = $isSosial;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsBudaya(): bool
	{
		return $this->isBudaya ?? false;
	}

	/**
	 * @param bool $isBudaya
	 * @return $this
	 */
	public function setIsBudaya(bool $isBudaya): LayananEntity
	{
		$this->isBudaya = $isBudaya;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsAgama(): bool
	{
		return $this->isAgama ?? false;
	}

	/**
	 * @param bool $isAgama
	 * @return $this
	 */
	public function setIsAgama(bool $isAgama): LayananEntity
	{
		$this->isAgama = $isAgama;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsKamtibmas(): bool
	{
		return $this->isKamtibmas ?? false;
	}

	/**
	 * @param bool $isKamtibmas
	 * @return $this
	 */
	public function setIsKamtibmas(bool $isKamtibmas): LayananEntity
	{
		$this->isKamtibmas = $isKamtibmas;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsKriminalitas(): bool
	{
		return $this->isKriminalitas ?? false;
	}

	/**
	 * @param bool $isKriminalitas
	 * @return $this
	 */
	public function setIsKriminalitas(bool $isKriminalitas): LayananEntity
	{
		$this->isKriminalitas = $isKriminalitas;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsTibcarLantas(): bool
	{
		return $this->isTibcarLantas ?? false;
	}

	/**
	 * @param bool $isTibcarLantas
	 * @return $this
	 */
	public function setIsTibcarLantas(bool $isTibcarLantas): LayananEntity
	{
		$this->isTibcarLantas = $isTibcarLantas;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsPrilakuPolri(): bool
	{
		return $this->isPrilakuPolri ?? false;
	}

	/**
	 * @param bool $isPrilakuPolri
	 * @return $this
	 */
	public function setIsPrilakuPolri(bool $isPrilakuPolri): LayananEntity
	{
		$this->isPrilakuPolri = $isPrilakuPolri;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsYanPolri(): bool
	{
		return $this->isYanPolri ?? false;
	}

	/**
	 * @param bool $isYanPolri
	 * @return $this
	 */
	public function setIsYanPolri(bool $isYanPolri): LayananEntity
	{
		$this->isYanPolri = $isYanPolri;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsLainLain(): bool
	{
		return $this->isLainLain ?? false;
	}

	/**
	 * @param bool $isLainLain
	 * @return $this
	 */
	public function setIsLainLain(bool $isLainLain): LayananEntity
	{
		$this->isLainLain = $isLainLain;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPermasalahan(): string|null
	{
		return $this->permasalahan ?? null;
	}

	/**
	 * @param string|null $permasalahan
	 * @return $this
	 */
	public function setPermasalahan(string|null $permasalahan): LayananEntity
	{
		$this->permasalahan = $permasalahan;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getSolusi(): string|null
	{
		return $this->solusi ?? null;
	}

	/**
	 * @param string|null $solusi
	 * @return $this
	 */
	public function setSolusi(string|null $solusi): LayananEntity
	{
		$this->solusi = $solusi;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getIdPetugas(): string|null
	{
		return $this->idPetugas ?? null;
	}

	/**
	 * @param string|null $idPetugas
	 * @return $this
	 */
	public function setIdPetugas(string|null $idPetugas): LayananEntity
	{
		$this->idPetugas = $idPetugas;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getNamaPetugas(): string|null
	{
		return $this->namaPetugas;
	}

	/**
	 * @param string|null $namaPetugas
	 * @return LayananEntity
	 */
	public function setNamaPetugas(string|null $namaPetugas): LayananEntity
	{
		$this->namaPetugas = $namaPetugas;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCreatedAt(): string|null
	{
		return $this->createdAt ?? null;
	}

	/**
	 * @param string|null $createdAt
	 * @return $this
	 */
	public function setCreatedAt(string|null $createdAt): LayananEntity
	{
		$this->createdAt = $createdAt;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCreatedBy(): string|null
	{
		return $this->createdBy ?? null;
	}

	/**
	 * @param string|null $createdBy
	 * @return $this
	 */
	public function setCreatedBy(string|null $createdBy): LayananEntity
	{
		$this->createdBy = $createdBy;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getUpdatedAt(): string|null
	{
		return $this->updatedAt ?? null;
	}

	/**
	 * @param string|null $updatedAt
	 * @return $this
	 */
	public function setUpdatedAt(string|null $updatedAt): LayananEntity
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getUpdatedBy(): string|null
	{
		return $this->updatedBy ?? null;
	}

	/**
	 * @param string|null $updatedBy
	 * @return $this
	 */
	public function setUpdatedBy(string|null $updatedBy): LayananEntity
	{
		$this->updatedBy = $updatedBy;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsDeleted(): bool
	{
		return $this->isDeleted ?? false;
	}

	/**
	 * @param bool $isDeleted
	 * @return $this
	 */
	public function setIsDeleted(bool $isDeleted): LayananEntity
	{
		$this->isDeleted = $isDeleted;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getDeletedAt(): string|null
	{
		return $this->deletedAt ?? null;
	}

	/**
	 * @param string|null $deletedAt
	 * @return $this
	 */
	public function setDeletedAt(string|null $deletedAt): LayananEntity
	{
		$this->deletedAt = $deletedAt;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getDeletedBy(): string|null
	{
		return $this->deletedBy ?? null;
	}

	/**
	 * @param string|null $deletedBy
	 * @return $this
	 */
	public function setDeletedBy(string|null $deletedBy): LayananEntity
	{
		$this->deletedBy = $deletedBy;
		return $this;
	}
}