<?php
namespace Base\Http;

class Scheme
{
	private $scheme;

	public function __construct(string $scheme)
	{
		$this->scheme = $scheme;
	}

	public function __toString(): string
	{
		return "{$this->scheme}:";
	}
}
