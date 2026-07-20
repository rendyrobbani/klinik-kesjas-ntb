<?php

namespace RendyRobbani\Klinik\Kesjas\NTB\App\Exception;

class BadRequestException extends \Exception
{
	private array $errors;

	/**
	 * @param array $errors
	 */
	public function __construct(array $errors)
	{
		$this->errors = $errors;
		parent::__construct("Bad request", 400);
	}

	public function getErrors(): array
	{
		return $this->errors;
	}
}