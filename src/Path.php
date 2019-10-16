<?php
declare(strict_types=1);

namespace Base\Http;

class Path
{
	private $parts;

	public function __construct(string ...$parts)
	{
		$this->parts = $parts;
	}

	public function extend(string ...$parts): Path
	{
		return new Path(...array_merge($this->parts, $parts));
	}

	public function __toString()
	{
		// TODO Url Encode.
		if ([] === $this->parts)
		{
			return '';
		}

		return '/' . implode('/', $this->parts);
	}
}
