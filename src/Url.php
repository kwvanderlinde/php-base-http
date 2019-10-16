<?php
namespace Base\Http;

class Url
{
	private $scheme;
	private $authority;
	private $path;
	private $query;

	public function __construct(Scheme $scheme, Authority $authority, Path $path, Query $query)
	{
		$this->scheme = $scheme;
		$this->authority = $authority;
		$this->path = $path;
		$this->query = $query;
	}

	public function __toString(): string
	{
		return "{$this->scheme}{$this->authority}{$this->path}{$this->query}";
	}

	public function getScheme(): Scheme
	{
		return $this->scheme;
	}

	public function getAuthority(): Authority
	{
		return $this->authority;
	}

	public function getPath(): Path
	{
		return $this->path;
	}

	public function getQuery(): Query
	{
		return $this->query;
	}

	public function subPath(string ...$parts): Url
	{
		return new Url(
			$this->scheme,
			$this->authority,
			$this->path->extend(...$parts),
			$this->query
		);
	}

	public function subQuery(string ...$parts): Url
	{
		return new Url(
			$this->scheme,
			$this->authority,
			$this->path,
			$this->query->extend(...$parts)
		);
	}
}
