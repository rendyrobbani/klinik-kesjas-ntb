<?php

declare(strict_types=1);

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Response;

use PHPUnit\Framework\TestCase;
use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\LayananEntity;

class LayananResponseTest extends TestCase
{
	public function testFromEntity(): void
	{
		$entity = (new LayananEntity())
			->setId(1)
			->setNomor(10)
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
			->setIdPetugas("198765")
			->setCreatedAt("2025-01-01 08:00:00")
			->setCreatedBy("admin")
			->setUpdatedAt("2025-01-02 09:00:00")
			->setUpdatedBy("editor")
			->setIsDeleted(false)
			->setDeletedAt(null)
			->setDeletedBy(null);

		$response = LayananResponse::fromEntity($entity);

		$this->assertSame(1, $response->id);
		$this->assertSame(10, $response->nomor);
		$this->assertSame("2025-01-01", $response->tanggal);
		$this->assertSame("SP-001", $response->nomorSurat);
		$this->assertSame("2025-01-02", $response->tanggalSurat);
		$this->assertSame("Komunitas A", $response->komunitas);
		$this->assertSame("Budi", $response->nama);
		$this->assertSame(1, $response->jenis);
		$this->assertSame(30, $response->umur);
		$this->assertSame("Guru", $response->pekerjaan);
		$this->assertSame("Mataram", $response->alamat);
		$this->assertSame("08123456789", $response->telepon);

		$this->assertTrue($response->isPelayanan);
		$this->assertFalse($response->isIdeologi);
		$this->assertTrue($response->isPolitik);
		$this->assertFalse($response->isSosial);
		$this->assertTrue($response->isBudaya);
		$this->assertFalse($response->isAgama);
		$this->assertTrue($response->isKamtibmas);
		$this->assertFalse($response->isKriminalitas);
		$this->assertTrue($response->isTibcarLantas);
		$this->assertFalse($response->isPrilakuPolri);
		$this->assertTrue($response->isYanPolri);
		$this->assertFalse($response->isLainLain);

		$this->assertSame("Permasalahan", $response->permasalahan);
		$this->assertSame("Solusi", $response->solusi);
		$this->assertSame("198765", $response->idPetugas);

		$this->assertSame("2025-01-01 08:00:00", $response->createdAt);
		$this->assertSame("admin", $response->createdBy);
		$this->assertSame("2025-01-02 09:00:00", $response->updatedAt);
		$this->assertSame("editor", $response->updatedBy);

		$this->assertFalse($response->isDeleted);
		$this->assertNull($response->deletedAt);
		$this->assertNull($response->deletedBy);
	}
}