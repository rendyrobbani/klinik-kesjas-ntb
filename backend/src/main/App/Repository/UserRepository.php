<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Repository;

use RendyRobbani\Klinik\Kesjas\NTB\App\Entity\UserEntity;

interface UserRepository
{
	/**
	 * @return UserEntity[]
	 * @throws \Exception
	 */
	function selectAll(): array;

	/**
	 * @param string $id
	 * @return UserEntity|null
	 * @throws \Exception
	 */
	function selectById(string $id): ?UserEntity;

	/**
	 * @param UserEntity $user
	 * @return UserEntity
	 * @throws \Exception
	 */
	function save(UserEntity $user): UserEntity;

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