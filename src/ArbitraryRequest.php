<?php
declare(strict_types=1);

namespace Base\Http;

class ArbitraryRequest extends BaseRequest
{
	private $body;

	public function withBody($body): self
	{
		$this->body = $body;
		return $this;
	}

	public function getBody()
	{
		return $this->body;
	}
}
