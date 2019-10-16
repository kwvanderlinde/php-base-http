<?php
namespace Base\Http;

class Authority
{
	private $userInfo;
	private $host;
	private $port;

	public function __construct(string $userInfo = null, string $host, string $port = null)
	{
		$this->userInfo = $userInfo;
		$this->host = $host;
		$this->port = $port;
	}

	public function __toString(): string
	{
		// TODO URL Encode

		$result = '//';
		if (is_string($this->userInfo))
		{
			$result .= "{$this->userInfo}@";
		}
		$result .= $this->host;
		if (is_string($this->port))
		{
			$result .= ":{$this->port}";
		}

		return $result;
	}
}
