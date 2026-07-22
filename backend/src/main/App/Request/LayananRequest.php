<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Request;

class LayananRequest
{
	private int|null $nomor;

	private string|null $tanggal;

	private string|null $nama;

	private int|null $jenis;

	private int|null $umur;

	private string|null $pekerjaan;

	private string|null $alamat;

	private string|null $telepon;

	private bool $isPelayanan;

	private bool $isIdeologi;

	private bool $isPolitik;

	private bool $isSosial;

	private bool $isBudaya;

	private bool $isAgama;

	private bool $isKamtibmas;

	private bool $isKriminalitas;

	private bool $isTibcarLantas;

	private bool $isPrilakuPolri;

	private bool $isYanPolri;

	private bool $isLainLain;

	private string|null $permasalahan;

	private string|null $solusi;

	private mixed $dokumentasi;

	private string|null $dokumentasiExt;

	public function validate(): array
	{
		$errors = [];
		if (!isset($this->nomor) || $this->nomor == null || $this->nomor == 0) $errors["Nomor Kunjungan"] = ["tidak boleh kosong"];
		if (!isset($this->tanggal) || $this->tanggal == null || trim($this->tanggal) == "") $errors["Tanggal"] = ["tidak boleh kosong"];
		if (!isset($this->nama) || $this->nama == null || trim($this->nama) == "") $errors["Nama"] = ["tidak boleh kosong"];
		if (!isset($this->jenis) || $this->jenis == null || $this->jenis == 0) $errors["Jenis"] = ["tidak boleh kosong"];
		if (!isset($this->umur) || $this->umur == null || $this->umur == 0) $errors["Umur"] = ["tidak boleh kosong"];
		if (!isset($this->pekerjaan) || $this->pekerjaan == null || trim($this->pekerjaan) == "") $errors["Pekerjaan"] = ["tidak boleh kosong"];
		if (!isset($this->alamat) || $this->alamat == null || trim($this->alamat) == "") $errors["Alamat"] = ["tidak boleh kosong"];
		if (!isset($this->telepon) || $this->telepon == null || trim($this->telepon) == "") $errors["Telepon"] = ["tidak boleh kosong"];
		if (!isset($this->permasalahan) || $this->permasalahan == null || trim($this->permasalahan) == "") $errors["Permasalahan"] = ["tidak boleh kosong"];
		if (!isset($this->solusi) || $this->solusi == null || trim($this->solusi) == "") $errors["Solusi"] = ["tidak boleh kosong"];
		if (!isset($this->dokumentasi) || $this->dokumentasi == null) $errors["Dokumentasi"] = ["tidak boleh kosong"];
		if (!isset($this->dokumentasiExt) || $this->dokumentasiExt == null || trim($this->dokumentasiExt) == "") $errors["Dokumentasi"] = ["tidak boleh kosong"];
		return $errors;
	}

	public function getNomor(): int|null
	{
		return $this->nomor;
	}

	public function setNomor(int|null $nomor): LayananRequest
	{
		$this->nomor = $nomor;
		return $this;
	}

	public function getTanggal(): string|null
	{
		return $this->tanggal ?? null;
	}

	public function setTanggal(string|null $tanggal): LayananRequest
	{
		$this->tanggal = $tanggal;
		return $this;
	}

	public function getNama(): string|null
	{
		return $this->nama ?? null;
	}

	public function setNama(string|null $nama): LayananRequest
	{
		$this->nama = $nama;
		return $this;
	}

	public function getJenis(): int|null
	{
		return $this->jenis ?? null;
	}

	public function setJenis(int|null $jenis): LayananRequest
	{
		$this->jenis = $jenis;
		return $this;
	}

	public function getUmur(): int|null
	{
		return $this->umur ?? null;
	}

	public function setUmur(int|null $umur): LayananRequest
	{
		$this->umur = $umur;
		return $this;
	}

	public function getPekerjaan(): string|null
	{
		return $this->pekerjaan ?? null;
	}

	public function setPekerjaan(string|null $pekerjaan): LayananRequest
	{
		$this->pekerjaan = $pekerjaan;
		return $this;
	}

	public function getAlamat(): string|null
	{
		return $this->alamat ?? null;
	}

	public function setAlamat(string|null $alamat): LayananRequest
	{
		$this->alamat = $alamat;
		return $this;
	}

	public function getTelepon(): string|null
	{
		return $this->telepon ?? null;
	}

	public function setTelepon(string|null $telepon): LayananRequest
	{
		$this->telepon = $telepon;
		return $this;
	}

	public function getIsPelayanan(): bool
	{
		return $this->isPelayanan ?? false;
	}

	public function setIsPelayanan(bool $isPelayanan): LayananRequest
	{
		$this->isPelayanan = $isPelayanan;
		return $this;
	}

	public function getIsIdeologi(): bool
	{
		return $this->isIdeologi ?? false;
	}

	public function setIsIdeologi(bool $isIdeologi): LayananRequest
	{
		$this->isIdeologi = $isIdeologi;
		return $this;
	}

	public function getIsPolitik(): bool
	{
		return $this->isPolitik ?? false;
	}

	public function setIsPolitik(bool $isPolitik): LayananRequest
	{
		$this->isPolitik = $isPolitik;
		return $this;
	}

	public function getIsSosial(): bool
	{
		return $this->isSosial ?? false;
	}

	public function setIsSosial(bool $isSosial): LayananRequest
	{
		$this->isSosial = $isSosial;
		return $this;
	}

	public function getIsBudaya(): bool
	{
		return $this->isBudaya ?? false;
	}

	public function setIsBudaya(bool $isBudaya): LayananRequest
	{
		$this->isBudaya = $isBudaya;
		return $this;
	}

	public function getIsAgama(): bool
	{
		return $this->isAgama ?? false;
	}

	public function setIsAgama(bool $isAgama): LayananRequest
	{
		$this->isAgama = $isAgama;
		return $this;
	}

	public function getIsKamtibmas(): bool
	{
		return $this->isKamtibmas ?? false;
	}

	public function setIsKamtibmas(bool $isKamtibmas): LayananRequest
	{
		$this->isKamtibmas = $isKamtibmas;
		return $this;
	}

	public function getIsKriminalitas(): bool
	{
		return $this->isKriminalitas ?? false;
	}

	public function setIsKriminalitas(bool $isKriminalitas): LayananRequest
	{
		$this->isKriminalitas = $isKriminalitas;
		return $this;
	}

	public function getIsTibcarLantas(): bool
	{
		return $this->isTibcarLantas ?? false;
	}

	public function setIsTibcarLantas(bool $isTibcarLantas): LayananRequest
	{
		$this->isTibcarLantas = $isTibcarLantas;
		return $this;
	}

	public function getIsPrilakuPolri(): bool
	{
		return $this->isPrilakuPolri ?? false;
	}

	public function setIsPrilakuPolri(bool $isPrilakuPolri): LayananRequest
	{
		$this->isPrilakuPolri = $isPrilakuPolri;
		return $this;
	}

	public function getIsYanPolri(): bool
	{
		return $this->isYanPolri ?? false;
	}

	public function setIsYanPolri(bool $isYanPolri): LayananRequest
	{
		$this->isYanPolri = $isYanPolri;
		return $this;
	}

	public function getIsLainLain(): bool
	{
		return $this->isLainLain ?? false;
	}

	public function setIsLainLain(bool $isLainLain): LayananRequest
	{
		$this->isLainLain = $isLainLain;
		return $this;
	}

	public function getPermasalahan(): string|null
	{
		return $this->permasalahan ?? null;
	}

	public function setPermasalahan(string|null $permasalahan): LayananRequest
	{
		$this->permasalahan = $permasalahan;
		return $this;
	}

	public function getSolusi(): string|null
	{
		return $this->solusi ?? null;
	}

	public function setSolusi(string|null $solusi): LayananRequest
	{
		$this->solusi = $solusi;
		return $this;
	}

	public function getDokumentasi(): mixed
	{
		return $this->dokumentasi;
	}

	public function setDokumentasi(mixed $dokumentasi): LayananRequest
	{
		$this->dokumentasi = $dokumentasi;
		return $this;
	}

	public function getDokumentasiExt(): string|null
	{
		return $this->dokumentasiExt;
	}

	public function setDokumentasiExt(string|null $dokumentasiExt): LayananRequest
	{
		$this->dokumentasiExt = $dokumentasiExt;
		return $this;
	}
}