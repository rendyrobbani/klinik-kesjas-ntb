<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Entity;

class UserEntity
{
	private string $id;

	private string $nama;

	private string $password;

	private null|string $createdAt;

	private null|string $createdBy;

	private null|string $updatedAt;

	private null|string $updatedBy;

	private bool $isDeleted;

	private null|string $deletedAt;

	private null|string $deletedBy;

	public function getId(): string
	{
		return $this->id;
	}

	public function setId(string $id): UserEntity
	{
		$this->id = $id;
		return $this;
	}

	public function getNama(): string
	{
		return $this->nama;
	}

	public function setNama(string $nama): UserEntity
	{
		$this->nama = $nama;
		return $this;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function setPassword(string $password): UserEntity
	{
		$this->password = $password;
		return $this;
	}

	public function getCreatedAt(): null|string
	{
		return $this->createdAt;
	}

	public function setCreatedAt(null|string $createdAt): UserEntity
	{
		$this->createdAt = $createdAt;
		return $this;
	}

	public function getCreatedBy(): null|string
	{
		return $this->createdBy;
	}

	public function setCreatedBy(null|string $createdBy): UserEntity
	{
		$this->createdBy = $createdBy;
		return $this;
	}

	public function getUpdatedAt(): null|string
	{
		return $this->updatedAt;
	}

	public function setUpdatedAt(null|string $updatedAt): UserEntity
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}

	public function getUpdatedBy(): null|string
	{
		return $this->updatedBy;
	}

	public function setUpdatedBy(null|string $updatedBy): UserEntity
	{
		$this->updatedBy = $updatedBy;
		return $this;
	}

	public function getIsDeleted(): bool
	{
		return $this->isDeleted;
	}

	public function setIsDeleted(bool $isDeleted): UserEntity
	{
		$this->isDeleted = $isDeleted;
		return $this;
	}

	public function getDeletedAt(): null|string
	{
		return $this->deletedAt;
	}

	public function setDeletedAt(null|string $deletedAt): UserEntity
	{
		$this->deletedAt = $deletedAt;
		return $this;
	}

	public function getDeletedBy(): null|string
	{
		return $this->deletedBy;
	}

	public function setDeletedBy(null|string $deletedBy): UserEntity
	{
		$this->deletedBy = $deletedBy;
		return $this;
	}
}