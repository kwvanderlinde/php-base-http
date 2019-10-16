<?php
declare(strict_types=1);

namespace Base\Http;

class MemoizedRequest implements Request
{
	private $impl;
	private $notSetSentinel;

	private $method;
	private $url;
	private $headers;
	private $body;

	public function __construct(Request $impl)
	{
		$this->impl = $impl;
		$this->notSetSentinel = new \stdClass();

		$this->method = $this->notSetSentinel;
		$this->url = $this->notSetSentinel;
		$this->headers = $this->notSetSentinel;
		$this->body = $this->notSetSentinel;
	}

	public function getMethod(): string
	{
		if ($this->notSetSentinel === $this->method)
		{
			$this->method = $this->impl->getMethod();
		}

		return $this->method;
	}

	public function withCookies(array $cookies): void
	{
		$this->impl->withCookies($cookies);
		$this->headers = $this->notSetSentinel;
	}

	public function getUrl(): Url
	{
		if ($this->notSetSentinel === $this->url)
		{
			$this->url = $this->impl->getUrl();
		}

		return $this->url;
	}

	public function getHeaders(): array
	{
		if ($this->notSetSentinel === $this->headers)
		{
			$this->headers = $this->impl->getHeaders();
		}

		return $this->headers;
	}

	public function withHeader(string $key, string $value): void
	{
		$this->impl->withHeader($key, $value);
		$this->headers = $this->notSetSentinel;
	}

	public function getBody()
	{
		if ($this->notSetSentinel === $this->body)
		{
			$this->body = $this->impl->getBody();
		}

		return $this->body;
	}
}
