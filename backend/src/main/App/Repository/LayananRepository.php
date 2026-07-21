<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Repository;

use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\LayananEntity;

interface LayananRepository
{
	/**
	 * @return LayananEntity[]
	 * @throws \Exception
	 */
	function selectAll(): array;

	/**
	 * @param bool $isDeleted
	 * @return LayananEntity[]
	 * @throws \Exception
	 */
	function selectByIsDeleted(bool $isDeleted): array;

	/**
	 * @param string $id
	 * @return LayananEntity|null
	 * @throws \Exception
	 */
	function selectById(string $id): ?LayananEntity;

	/**
	 * @param LayananEntity $layanan
	 * @return LayananEntity
	 * @throws \Exception
	 */
	function save(LayananEntity $layanan): LayananEntity;

	/**
	 * @param string $actionAt
	 * @param string $actionBy
	 * @return void
	 * @throws \Exception
	 */
	function deleteAll(string $actionAt, string $actionBy): void;

	/**
	 * @param string $actionAt
	 * @param string $actionBy
	 * @param string $id
	 * @return void
	 * @throws \Exception
	 */
	function deleteById(string $actionAt, string $actionBy, string $id): void;
}