<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Service;

use RendyRobbani\Klinik\Kesjas\NTB\App\Request\LayananRequest;
use RendyRobbani\Klinik\Kesjas\NTB\App\Response\LayananResponse;

interface LayananService
{
	/**
	 * @return LayananResponse[]
	 * @throws \Throwable
	 */
	function selectAll(): array;

	/**
	 * @param int $id
	 * @return LayananResponse
	 * @throws \Throwable
	 */
	function selectById(int $id): LayananResponse;

	/**
	 * @param LayananRequest $request
	 * @return LayananResponse
	 * @throws \Throwable
	 */
	function create(LayananRequest $request): LayananResponse;

	/**
	 * @param LayananRequest $request
	 * @param int $id
	 * @return LayananResponse
	 * @throws \Throwable
	 */
	function updateById(LayananRequest $request, int $id): LayananResponse;

	/**
	 * @param int $id
	 * @return LayananResponse
	 * @throws \Throwable
	 */
	function deleteById(int $id): LayananResponse;
}