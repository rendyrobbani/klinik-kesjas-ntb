<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Repository;

use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\LayananEntity;

readonly class LayananRepositoryImpl implements LayananRepository
{
	private \PDO $connection;

	public function __construct(\PDO $connection)
	{
		$this->connection = $connection;
	}

	private function toEntity(array $row): LayananEntity
	{
		return new LayananEntity()
			->setId($row["id"])
			->setNomor($row["nomor"])
			->setTanggal($row["tanggal"])
			->setNomorSurat($row["nomor_surat"])
			->setTanggalSurat($row["tanggal_surat"])
			->setKomunitas($row["komunitas"])
			->setNama($row["nama"])
			->setJenis($row["jenis"])
			->setUmur($row["umur"])
			->setPekerjaan($row["pekerjaan"])
			->setAlamat($row["alamat"])
			->setTelepon($row["telepon"])
			->setIsPelayanan($row["is_pelayanan"])
			->setIsIdeologi($row["is_ideologi"])
			->setIsPolitik($row["is_politik"])
			->setIsSosial($row["is_sosial"])
			->setIsBudaya($row["is_budaya"])
			->setIsAgama($row["is_agama"])
			->setIsKamtibmas($row["is_kamtibmas"])
			->setIsKriminalitas($row["is_kriminalitas"])
			->setIsTibcarLantas($row["is_tibcar_lantas"])
			->setIsPrilakuPolri($row["is_prilaku_polri"])
			->setIsYanPolri($row["is_yan_polri"])
			->setIsLainLain($row["is_lain_lain"])
			->setPermasalahan($row["permasalahan"])
			->setSolusi($row["solusi"])
			->setIdPetugas($row["id_petugas"])
			->setCreatedAt($row["created_at"])
			->setCreatedBy($row["created_by"])
			->setUpdatedAt($row["updated_at"])
			->setUpdatedBy($row["updated_by"])
			->setIsDeleted($row["is_deleted"])
			->setDeletedAt($row["deleted_at"])
			->setDeletedBy($row["deleted_by"]);
	}

	/**
	 * @inheritDoc
	 */
	function selectAll(): array
	{
		$statement = $this->connection->prepare("select * from layanan");
		$statement->execute();
		$rows = $statement->fetchAll(\PDO::FETCH_NAMED);
		return array_map(fn($row) => $this->toEntity($row), $rows);
	}

	/**
	 * @inheritDoc
	 */
	function selectById(string $id): ?LayananEntity
	{
		$statement = $this->connection->prepare("select * from layanan where id = :id");
		$statement->bindValue("id", $id);
		$statement->execute();
		if ($row = $statement->fetch(\PDO::FETCH_NAMED)) return $this->toEntity($row);
		return null;
	}

	/**
	 * @inheritDoc
	 */
	function save(LayananEntity $layanan): LayananEntity
	{
		$sql = <<<SQL
		insert into layanan (id, nomor, tanggal, nomor_surat, tanggal_surat, komunitas, nama, jenis, umur, pekerjaan, alamat, telepon, is_pelayanan, is_ideologi, is_politik, is_sosial, is_budaya, is_agama, is_kamtibmas, is_kriminalitas, is_tibcar_lantas, is_prilaku_polri, is_yan_polri, is_lain_lain, permasalahan, solusi, id_petugas, created_at, created_by, updated_at, updated_by, is_deleted, deleted_at, deleted_by)
		values (:id, :nomor, :tanggal, :nomor_surat, :tanggal_surat, :komunitas, :nama, :jenis, :umur, :pekerjaan, :alamat, :telepon, :is_pelayanan, :is_ideologi, :is_politik, :is_sosial, :is_budaya, :is_agama, :is_kamtibmas, :is_kriminalitas, :is_tibcar_lantas, :is_prilaku_polri, :is_yan_polri, :is_lain_lain, :permasalahan, :solusi, :id_petugas, :created_at, :created_by, :updated_at, :updated_by, :is_deleted, :deleted_at, :deleted_by)
		on duplicate key update nomor            = :nomor
		                      , tanggal          = :tanggal
		                      , nomor_surat      = :nomor_surat
		                      , tanggal_surat    = :tanggal_surat
		                      , komunitas        = :komunitas
		                      , nama             = :nama
		                      , jenis            = :jenis
		                      , umur             = :umur
		                      , pekerjaan        = :pekerjaan
		                      , alamat           = :alamat
		                      , telepon          = :telepon
		                      , is_pelayanan     = :is_pelayanan
		                      , is_ideologi      = :is_ideologi
		                      , is_politik       = :is_politik
		                      , is_sosial        = :is_sosial
		                      , is_budaya        = :is_budaya
		                      , is_agama         = :is_agama
		                      , is_kamtibmas     = :is_kamtibmas
		                      , is_kriminalitas  = :is_kriminalitas
		                      , is_tibcar_lantas = :is_tibcar_lantas
		                      , is_prilaku_polri = :is_prilaku_polri
		                      , is_yan_polri     = :is_yan_polri
		                      , is_lain_lain     = :is_lain_lain
		                      , permasalahan     = :permasalahan
		                      , solusi           = :solusi
		                      , id_petugas       = :id_petugas
		                      , created_at       = :created_at
		                      , created_by       = :created_by
		                      , updated_at       = :updated_at
		                      , updated_by       = :updated_by
		                      , is_deleted       = :is_deleted
		                      , deleted_at       = :deleted_at
		                      , deleted_by       = :deleted_by
		SQL;
		$statement = $this->connection->prepare($sql);
		if ($layanan->getId() == null) {
			$statement->bindValue("id", null, \PDO::PARAM_NULL);
		} else {
			$statement->bindValue("id", $layanan->getId(), \PDO::PARAM_INT);
		}
		$statement->bindValue("nomor", $layanan->getNomor(), \PDO::PARAM_INT);
		$statement->bindValue("tanggal", $layanan->getTanggal());
		$statement->bindValue("nomor_surat", $layanan->getNomorSurat());
		$statement->bindValue("tanggal_surat", $layanan->getTanggalSurat());
		$statement->bindValue("komunitas", $layanan->getKomunitas());
		$statement->bindValue("nama", $layanan->getNama());
		$statement->bindValue("jenis", $layanan->getJenis(), \PDO::PARAM_INT);
		$statement->bindValue("umur", $layanan->getUmur(), \PDO::PARAM_INT);
		$statement->bindValue("pekerjaan", $layanan->getPekerjaan());
		$statement->bindValue("alamat", $layanan->getAlamat());
		$statement->bindValue("telepon", $layanan->getTelepon());
		$statement->bindValue("is_pelayanan", $layanan->getIsPelayanan(), \PDO::PARAM_BOOL);
		$statement->bindValue("is_ideologi", $layanan->getIsIdeologi(), \PDO::PARAM_BOOL);
		$statement->bindValue("is_politik", $layanan->getIsPolitik(), \PDO::PARAM_BOOL);
		$statement->bindValue("is_sosial", $layanan->getIsSosial(), \PDO::PARAM_BOOL);
		$statement->bindValue("is_budaya", $layanan->getIsBudaya(), \PDO::PARAM_BOOL);
		$statement->bindValue("is_agama", $layanan->getIsAgama(), \PDO::PARAM_BOOL);
		$statement->bindValue("is_kamtibmas", $layanan->getIsKamtibmas(), \PDO::PARAM_BOOL);
		$statement->bindValue("is_kriminalitas", $layanan->getIsKriminalitas(), \PDO::PARAM_BOOL);
		$statement->bindValue("is_tibcar_lantas", $layanan->getIsTibcarLantas(), \PDO::PARAM_BOOL);
		$statement->bindValue("is_prilaku_polri", $layanan->getIsPrilakuPolri(), \PDO::PARAM_BOOL);
		$statement->bindValue("is_yan_polri", $layanan->getIsYanPolri(), \PDO::PARAM_BOOL);
		$statement->bindValue("is_lain_lain", $layanan->getIsLainLain(), \PDO::PARAM_BOOL);
		$statement->bindValue("permasalahan", $layanan->getPermasalahan());
		$statement->bindValue("solusi", $layanan->getSolusi());
		$statement->bindValue("id_petugas", $layanan->getIdPetugas());
		$statement->bindValue("created_at", $layanan->getCreatedAt());
		$statement->bindValue("created_by", $layanan->getCreatedBy());
		$statement->bindValue("updated_at", $layanan->getUpdatedAt());
		$statement->bindValue("updated_by", $layanan->getUpdatedBy());
		$statement->bindValue("is_deleted", $layanan->getIsDeleted(), \PDO::PARAM_BOOL);
		$statement->bindValue("deleted_at", $layanan->getDeletedAt());
		$statement->bindValue("deleted_by", $layanan->getDeletedBy());
		$statement->execute();
		if ($layanan->getId() == null) $layanan->setId($this->connection->lastInsertId());
		return $layanan;
	}

	/**
	 * @inheritDoc
	 */
	function deleteAll(string $actionAt, string $actionBy): void
	{
		$sql = <<<SQL
		update layanan
		set is_deleted = true
		  , deleted_at = :action_at
		  , deleted_by = :action_by
		SQL;
		$statement = $this->connection->prepare($sql);
		$statement->bindValue("action_at", $actionAt);
		$statement->bindValue("action_by", $actionBy);
		$statement->execute();
	}

	/**
	 * @inheritDoc
	 */
	function deleteById(string $actionAt, string $actionBy, string $id): void
	{
		$sql = <<<SQL
		update layanan
		set is_deleted = true
		  , deleted_at = :action_at
		  , deleted_by = :action_by
		where id = :id
		SQL;
		$statement = $this->connection->prepare($sql);
		$statement->bindValue("action_at", $actionAt);
		$statement->bindValue("action_by", $actionBy);
		$statement->bindValue("id", $id);
		$statement->execute();
	}
}