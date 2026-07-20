<?php

declare(strict_types=1);

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Entity;

use PHPUnit\Framework\TestCase;

class LayananEntityTest extends TestCase
{
	public function testSetterAndGetter(): void
	{
		$entity = new LayananEntity();

		$result = $entity
			->setId(1)
			->setNomor(100)
			->setTanggal('2025-01-01')
			->setNomorSurat('001/SP')
			->setTanggalSurat('2025-01-02')
			->setKomunitas('Komunitas A')
			->setNama('Budi')
			->setJenis(2)
			->setUmur(35)
			->setPekerjaan('Guru')
			->setAlamat('Mataram')
			->setTelepon('08123456789')
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
			->setPermasalahan('Permasalahan')
			->setSolusi('Solusi')
			->setIdPetugas('USR001')
			->setCreatedAt('2025-01-01 10:00:00')
			->setCreatedBy('admin')
			->setUpdatedAt('2025-01-02 10:00:00')
			->setUpdatedBy('editor')
			->setIsDeleted(false)
			->setDeletedAt(null)
			->setDeletedBy(null);

		$this->assertSame($entity, $result);

		$this->assertSame(1, $entity->getId());
		$this->assertSame(100, $entity->getNomor());
		$this->assertSame('2025-01-01', $entity->getTanggal());
		$this->assertSame('001/SP', $entity->getNomorSurat());
		$this->assertSame('2025-01-02', $entity->getTanggalSurat());
		$this->assertSame('Komunitas A', $entity->getKomunitas());
		$this->assertSame('Budi', $entity->getNama());
		$this->assertSame(2, $entity->getJenis());
		$this->assertSame(35, $entity->getUmur());
		$this->assertSame('Guru', $entity->getPekerjaan());
		$this->assertSame('Mataram', $entity->getAlamat());
		$this->assertSame('08123456789', $entity->getTelepon());

		$this->assertTrue($entity->isPelayanan());
		$this->assertFalse($entity->isIdeologi());
		$this->assertTrue($entity->isPolitik());
		$this->assertFalse($entity->isSosial());
		$this->assertTrue($entity->isBudaya());
		$this->assertFalse($entity->isAgama());
		$this->assertTrue($entity->isKamtibmas());
		$this->assertFalse($entity->isKriminalitas());
		$this->assertTrue($entity->isTibcarLantas());
		$this->assertFalse($entity->isPrilakuPolri());
		$this->assertTrue($entity->isYanPolri());
		$this->assertFalse($entity->isLainLain());

		$this->assertSame('Permasalahan', $entity->getPermasalahan());
		$this->assertSame('Solusi', $entity->getSolusi());
		$this->assertSame('USR001', $entity->getIdPetugas());

		$this->assertSame('2025-01-01 10:00:00', $entity->getCreatedAt());
		$this->assertSame('admin', $entity->getCreatedBy());

		$this->assertSame('2025-01-02 10:00:00', $entity->getUpdatedAt());
		$this->assertSame('editor', $entity->getUpdatedBy());

		$this->assertFalse($entity->isDeleted());
		$this->assertNull($entity->getDeletedAt());
		$this->assertNull($entity->getDeletedBy());
	}
}