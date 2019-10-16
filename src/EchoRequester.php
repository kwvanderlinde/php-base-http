<?php
declare(strict_types=1);

namespace Base\Http;

class EchoRequester implements Requester
{
	private $impl;

	public function __construct(Requester $impl)
	{
		$this->impl = $impl;
	}

	public function send(Request $request): Response
	{
		$baseUrl = new Url($request->getUrl()->getScheme(), $request->getUrl()->getAuthority(), new Path(), new Query());
		echo "Connecting to {$baseUrl}\n";

		echo "Request:\n";
		echo "--------\n";
		echo "{$request->getMethod()} {$request->getUrl()->getPath()}{$request->getUrl()->getQuery()}\n";
		foreach ($request->getHeaders() as list($name, $value))
		{
			echo "{$name}: {$value}\n";
		}
		$body = json_encode($request->getBody(), JSON_PRETTY_PRINT);
		echo "$body\n\n";

		$response = $this->impl->send($request);

		echo "Response:\n";
		echo "---------\n";
		foreach ($response->getHeaders() as $header)
		{
			echo "{$header}\n";
		}

		$decodedJson = json_decode($response->getBody());
		if (null === $decodedJson)
		{
			// This was not a JSON response. Do not pretty print.
			echo "{$response->getBody()}";
		}
		else
		{
			// This is a JSON response. Let's show it nicely.
			$encoded = json_encode($decodedJson, JSON_PRETTY_PRINT);
			echo "{$encoded}";
		}

		echo "\n\n";

		return $response;
	}
}
