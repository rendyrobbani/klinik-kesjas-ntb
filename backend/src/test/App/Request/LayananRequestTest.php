<?php

declare(strict_types=1);

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Request;

use PHPUnit\Framework\TestCase;

class LayananRequestTest extends TestCase
{
	public function testGetterAndSetter(): void
	{
		$request = new LayananRequest();

		$result = $request
			->setTanggal("2025-01-01")
			->setNomorSurat("SP-001")
			->setTanggalSurat("2025-01-02")
			->setKomunitas("Komunitas A")
			->setNama("Budi")
			->setJenis(1)
			->setUmur(30)
			->setPekerjaan("Guru")
			->setAlamat("Mataram")
			->setTelepon("08123456789")
			->setIsPelayanan(true)
			->setIsIdeologi(false)
			->setIsPolitik(true)
			->setIsSosial(false)
			->setIsBudaya(true)
			->setIsAgama(false)
			->setIsKamtibmas(true)
			->setIsKriminalitas(false)
			->setIsTibcarLantas(true)
			->setIsPrilakuPolri(false)
			->setIsYanPolri(true)
			->setIsLainLain(false)
			->setPermasalahan("Permasalahan")
			->setSolusi("Solusi")
			->setIdPetugas("198765");

		$this->assertSame($request, $result);

		$this->assertSame("2025-01-01", $request->getTanggal());
		$this->assertSame("SP-001", $request->getNomorSurat());
		$this->assertSame("2025-01-02", $request->getTanggalSurat());
		$this->assertSame("Komunitas A", $request->getKomunitas());
		$this->assertSame("Budi", $request->getNama());
		$this->assertSame(1, $request->getJenis());
		$this->assertSame(30, $request->getUmur());
		$this->assertSame("Guru", $request->getPekerjaan());
		$this->assertSame("Mataram", $request->getAlamat());
		$this->assertSame("08123456789", $request->getTelepon());

		$this->assertTrue($request->getIsPelayanan());
		$this->assertFalse($request->getIsIdeologi());
		$this->assertTrue($request->getIsPolitik());
		$this->assertFalse($request->getIsSosial());
		$this->assertTrue($request->getIsBudaya());
		$this->assertFalse($request->getIsAgama());
		$this->assertTrue($request->getIsKamtibmas());
		$this->assertFalse($request->getIsKriminalitas());
		$this->assertTrue($request->getIsTibcarLantas());
		$this->assertFalse($request->getIsPrilakuPolri());
		$this->assertTrue($request->getIsYanPolri());
		$this->assertFalse($request->getIsLainLain());

		$this->assertSame("Permasalahan", $request->getPermasalahan());
		$this->assertSame("Solusi", $request->getSolusi());
		$this->assertSame("198765", $request->getIdPetugas());
	}

	public function testValidateReturnErrorsWhenDataEmpty(): void
	{
		$request = new LayananRequest();

		$errors = $request->validate();

		$this->assertArrayHasKey("Tanggal", $errors);
		$this->assertArrayHasKey("Nomor Surat Perintah", $errors);
		$this->assertArrayHasKey("Tanggal Surat Perintah", $errors);
		$this->assertArrayHasKey("Komunitas", $errors);
		$this->assertArrayHasKey("Nama", $errors);
		$this->assertArrayHasKey("Jenis", $errors);
		$this->assertArrayHasKey("Umur", $errors);
		$this->assertArrayHasKey("Pekerjaan", $errors);
		$this->assertArrayHasKey("Alamat", $errors);
		$this->assertArrayHasKey("Telepon", $errors);
		$this->assertArrayHasKey("Permasalahan", $errors);
		$this->assertArrayHasKey("Solusi", $errors);
		$this->assertArrayHasKey("NRP Petugas", $errors);
	}

	public function testValidateSuccess(): void
	{
		$request = (new LayananRequest())
			->setTanggal("2025-01-01")
			->setNomorSurat("SP-001")
			->setTanggalSurat("2025-01-02")
			->setKomunitas("Komunitas A")
			->setNama("Budi")
			->setJenis(1)
			->setUmur(30)
			->setPekerjaan("Guru")
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
			->setSolusi("Solusi")
			->setIdPetugas("198765");

		$this->assertSame([], $request->validate());
	}
}