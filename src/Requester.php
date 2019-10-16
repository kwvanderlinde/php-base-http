<?php
declare(strict_types=1);

namespace Base\Http;

interface Requester
{
	function send(Request $request): Response;
}
