<?php
declare(strict_types=1);

namespace Base\Http;

class BaseUrl
{
	private $url;

	public function __construct(string $url)
	{
		$this->url = $url;
	}

	public function __toString(): string
	{
		return $this->url;
	}
}
