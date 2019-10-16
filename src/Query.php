<?php
declare(strict_types=1);

namespace Base\Http;

class Query
{
	private $parts;

	public function __construct(string ...$parts)
	{
		$this->parts = $parts;
	}

	public function extend(string ...$parts): Query
	{
		return new Query(...array_merge($this->parts, $parts));
	}

	public function __toString(): string
	{
		// TODO URL Encode

		if ([] === $this->parts)
		{
			return '';
		}

		return '?' . implode('&', $this->parts);
	}
}
