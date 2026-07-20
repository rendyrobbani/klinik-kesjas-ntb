<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Repository;

use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\UserEntity;

readonly class UserRepositoryImpl implements UserRepository
{
	private \PDO $connection;

	public function __construct(\PDO $connection)
	{
		$this->connection = $connection;
	}

	private function toEntity(array $row): UserEntity
	{
		return new UserEntity()
			->setId($row["id"])
			->setNama($row["nama"])
			->setPassword($row["password"])
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
		$statement = $this->connection->prepare("select * from user");
		$statement->execute();
		$rows = $statement->fetchAll(\PDO::FETCH_NAMED);
		return array_map(fn($row) => $this->toEntity($row), $rows);
	}

	/**
	 * @inheritDoc
	 */
	function selectById(string $id): ?UserEntity
	{
		$statement = $this->connection->prepare("select * from user where id = :id");
		$statement->bindValue("id", $id);
		$statement->execute();
		if ($row = $statement->fetch(\PDO::FETCH_NAMED)) return $this->toEntity($row);
		return null;
	}

	/**
	 * @inheritDoc
	 */
	function save(UserEntity $user): UserEntity
	{
		$sql = <<<SQL
		insert into user(id, nama, password, created_at, created_by, updated_at, updated_by, is_deleted, deleted_at, deleted_by)
		values (:id, :nama, :password, :action_at, :created_at, :created_by, :updated_at, :updated_by, :is_deleted, :deleted_at)
		on duplicate key update nama       = :nama
		                      , password   = :password
		                      , created_at = :created_at
		                      , created_by = :created_by
		                      , updated_at = :updated_at
		                      , updated_by = :updated_by
		                      , is_deleted = :is_deleted
		                      , deleted_at = :deleted_at
		                      , deleted_by = :deleted_by
		SQL;
		$statement = $this->connection->prepare($sql);
		$statement->bindValue("nama", $user->getNama());
		$statement->bindValue("password", $user->getPassword());
		$statement->bindValue("created_at", $user->getCreatedAt());
		$statement->bindValue("created_by", $user->getCreatedBy());
		$statement->bindValue("updated_at", $user->getUpdatedAt());
		$statement->bindValue("updated_by", $user->getUpdatedBy());
		$statement->bindValue("is_deleted", $user->getIsDeleted());
		$statement->bindValue("deleted_at", $user->getDeletedAt());
		$statement->bindValue("deleted_by", $user->getDeletedBy());
		$statement->execute();
		return $user;
	}

	/**
	 * @inheritDoc
	 */
	function deleteAll(string $actionAt, string $actionBy): void
	{
		$sql = <<<SQL
		update user
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
		update user
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