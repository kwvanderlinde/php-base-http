<?php
declare(strict_types=1);

namespace Base\Http;

class BasicResponse implements Response
{
	private $body;

	public function __construct(string $body)
	{
		$this->body = $body;
	}

	public function getHeaders(): array
	{
		return [];
	}

	public function getBody(): string
	{
		return $this->body;
	}
}
