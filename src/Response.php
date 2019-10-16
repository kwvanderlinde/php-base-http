<?php
declare(strict_types=1);

namespace Base\Http;

interface Response
{
	function getHeaders(): array;

	function getBody();
}
