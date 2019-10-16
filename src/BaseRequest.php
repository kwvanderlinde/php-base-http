<?php
declare(strict_types=1);

namespace Base\Http;

abstract class BaseRequest implements Request
{
	private $method;

	private $url;

	// TODO Case-insensitive headers.
	private $headers;

	private $cookies;

	public function __construct(string $method, Url $url, array $headers)
	{
		$this->method = $method;
		$this->url = $url;
		$this->headers = $headers;
		$this->cookies = [];
	}

	public function withCookies(array $cookies): void
	{
		$this->cookies = array_merge($cookies, $this->cookies);
	}

	public function getMethod(): string
	{
		return $this->method;
	}

	public function getUrl(): Url
	{
		return $this->url;
	}

	public function getHeaders(): array
	{
		$cookies = [];
		foreach ($this->cookies as $name => $value)
		{
			$cookies[] = sprintf('%s=%s', $name, $value);
		}

		$headers = $this->headers;
		if ([] !== $cookies)
		{
			$headers[] = [ 'Cookie', implode('; ', $cookies) ];
		}


		return $headers;
	}

	public function withHeader(string $name, string $value): void
	{
		$this->headers[] = [ $name, $value ];
	}
}
