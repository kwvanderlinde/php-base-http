<?php
declare(strict_types=1);

namespace Base\Http;

interface Request
{
	function getMethod(): string;

	function getUrl(): Url;

	function withCookies(array $cookies): void;

	function getHeaders(): array;

	function withHeader(string $name, string $value): void;

	function getBody();
}
