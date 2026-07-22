<?php

declare(strict_types=1);

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Controller;

use PHPUnit\Framework\TestCase;
use RendyRobbani\Klinik\Kesjas\NTB\App\Response\LayananResponse;
use RendyRobbani\Klinik\Kesjas\NTB\App\Service\LayananService;

class LayananControllerTest extends TestCase
{
	private LayananService $layananService;

	private LayananController $controller;

	protected function setUp(): void
	{
		$this->layananService = $this->createMock(LayananService::class);

		$this->controller = new LayananController(
		);
	}

	private function captureOutput(callable $callback): string
	{
		ob_start();

		$callback();

		return ob_get_clean();
	}

	public function testSelectAll(): void
	{
		$response = [];

		$this->layananService
			->expects($this->once())
			->method("selectAll")
			->willReturn($response);

		$output = $this->captureOutput(
			fn() => $this->controller->selectAll()
		);

		$this->assertJson($output);

		$result = json_decode(
			$output,
			true
		);

		$this->assertSame([], $result);
	}

	public function testSelectById(): void
	{
		$response = $this->createMock(
			LayananResponse::class
		);

		$this->layananService
			->expects($this->once())
			->method("selectById")
			->with(1)
			->willReturn($response);

		$output = $this->captureOutput(
			fn() => $this->controller->selectById(1)
		);

		$this->assertJson($output);

		$result = json_decode(
			$output,
			true
		);

		$this->assertIsArray(
			$result
		);
	}

	public function testCreate(): void
	{
		$response = $this->createMock(
			LayananResponse::class
		);

		$this->layananService
			->expects($this->once())
			->method("create")
			->with(
				$this->isInstanceOf(
					\RendyRobbani\Klinik\Kesjas\NTB\App\Request\LayananRequest::class
				)
			)
			->willReturn($response);

		$output = $this->captureOutput(
			fn() => $this->controller->create()
		);

		$this->assertJson($output);

		$result = json_decode(
			$output,
			true
		);

		$this->assertIsArray(
			$result
		);
	}

	public function testUpdate(): void
	{
		$response = $this->createMock(
			LayananResponse::class
		);

		$this->layananService
			->expects($this->once())
			->method("update")
			->with(
				$this->isInstanceOf(
					\RendyRobbani\Klinik\Kesjas\NTB\App\Request\LayananRequest::class
				),
				1
			)
			->willReturn($response);

		$output = $this->captureOutput(
			fn() => $this->controller->update(1)
		);

		$this->assertJson($output);

		$result = json_decode(
			$output,
			true
		);

		$this->assertIsArray(
			$result
		);
	}

	public function testDeleteById(): void
	{
		$response = $this->createMock(
			LayananResponse::class
		);

		$this->layananService
			->expects($this->once())
			->method("deleteById")
			->with(1)
			->willReturn($response);

		$output = $this->captureOutput(
			fn() => $this->controller->deleteById(1)
		);

		$this->assertJson($output);

		$result = json_decode(
			$output,
			true
		);

		$this->assertIsArray(
			$result
		);
	}

	public function testSendJsonWithoutBody(): void
	{
		$output = $this->captureOutput(
			fn() => $this->controller->sendJson()
		);

		$this->assertJson($output);

		$result = json_decode(
			$output,
			true
		);

		$this->assertSame(
			200,
			$result["status"]
		);

		$this->assertSame(
			"Ok",
			$result["message"]
		);
	}
}