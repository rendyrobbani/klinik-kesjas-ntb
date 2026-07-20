<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Controller;

use RendyRobbani\Klinik\Kesjas\NTB\App\Request\LayananRequest;
use RendyRobbani\Klinik\Kesjas\NTB\App\Service\LayananService;

class LayananController extends AbstractController
{
	/**
	 * @var LayananService
	 */
	private LayananService $layananService;

	/**
	 * @param LayananService $layananService
	 */
	public function __construct(LayananService $layananService)
	{
		$this->layananService = $layananService;
		parent::__construct();
	}

	/**
	 * @return void
	 * @throws \Throwable
	 */
	public function selectAll(): void
	{
		$response = $this->layananService->selectAll();
		$this->sendJson(200, "Ok", $response);
	}

	/**
	 * @param int $id
	 * @return void
	 * @throws \Throwable
	 */
	public function selectById(int $id): void
	{
		$response = $this->layananService->selectById($id);
		$this->sendJson(200, "Ok", $response);
	}

	/**
	 * @return void
	 * @throws \Throwable
	 */
	public function create(): void
	{
		$request = json_decode(file_get_contents('php://input'), true);
		$response = $this->layananService->create((new LayananRequest())
			->setTanggal($request["tanggal"] ?? null)
			->setNomorSurat($request["nomorSurat"] ?? null)
			->setTanggalSurat($request["tanggalSurat"] ?? null)
			->setKomunitas($request["komunitas"] ?? null)
			->setNama($request["nama"] ?? null)
			->setJenis($request["jenis"] ?? null)
			->setUmur($request["umur"] ?? null)
			->setPekerjaan($request["pekerjaan"] ?? null)
			->setAlamat($request["alamat"] ?? null)
			->setTelepon($request["telepon"] ?? null)
			->setIsPelayanan($request["isPelayanan"] ?? false)
			->setIsIdeologi($request["isIdeologi"] ?? false)
			->setIsPolitik($request["isPolitik"] ?? false)
			->setIsSosial($request["isSosial"] ?? false)
			->setIsBudaya($request["isBudaya"] ?? false)
			->setIsAgama($request["isAgama"] ?? false)
			->setIsKamtibmas($request["isKamtibmas"] ?? false)
			->setIsKriminalitas($request["isKriminalitas"] ?? false)
			->setIsTibcarLantas($request["isTibcarLantas"] ?? false)
			->setIsPrilakuPolri($request["isPrilakuPolri"] ?? false)
			->setIsYanPolri($request["isYanPolri"] ?? false)
			->setIsLainLain($request["isLainLain"] ?? false)
			->setPermasalahan($request["permasalahan"] ?? null)
			->setSolusi($request["solusi"] ?? null)
			->setIdPetugas($request["idPetugas"] ?? null)
		);
		$this->sendJson(200, "Ok", $response);
	}

	/**
	 * @param int $id
	 * @return void
	 * @throws \Throwable
	 */
	public function update(int $id): void
	{
		$request = json_decode(file_get_contents('php://input'), true);
		$response = $this->layananService->update((new LayananRequest())
			->setTanggal($request["tanggal"] ?? null)
			->setNomorSurat($request["nomorSurat"] ?? null)
			->setTanggalSurat($request["tanggalSurat"] ?? null)
			->setKomunitas($request["komunitas"] ?? null)
			->setNama($request["nama"] ?? null)
			->setJenis($request["jenis"] ?? null)
			->setUmur($request["umur"] ?? null)
			->setPekerjaan($request["pekerjaan"] ?? null)
			->setAlamat($request["alamat"] ?? null)
			->setTelepon($request["telepon"] ?? null)
			->setIsPelayanan($request["isPelayanan"] ?? false)
			->setIsIdeologi($request["isIdeologi"] ?? false)
			->setIsPolitik($request["isPolitik"] ?? false)
			->setIsSosial($request["isSosial"] ?? false)
			->setIsBudaya($request["isBudaya"] ?? false)
			->setIsAgama($request["isAgama"] ?? false)
			->setIsKamtibmas($request["isKamtibmas"] ?? false)
			->setIsKriminalitas($request["isKriminalitas"] ?? false)
			->setIsTibcarLantas($request["isTibcarLantas"] ?? false)
			->setIsPrilakuPolri($request["isPrilakuPolri"] ?? false)
			->setIsYanPolri($request["isYanPolri"] ?? false)
			->setIsLainLain($request["isLainLain"] ?? false)
			->setPermasalahan($request["permasalahan"] ?? null)
			->setSolusi($request["solusi"] ?? null)
			->setIdPetugas($request["idPetugas"] ?? null),
			$id
		);
		$this->sendJson(200, "Ok", $response);
	}

	/**
	 * @param int $id
	 * @return void
	 * @throws \Throwable
	 */
	public function deleteById(int $id): void
	{
		$response = $this->layananService->deleteById($id);
		$this->sendJson(200, "Ok", $response);
	}
}