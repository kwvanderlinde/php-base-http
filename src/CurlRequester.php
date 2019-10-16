<?php
declare(strict_types=1);

namespace Base\Http;

class CurlRequester implements Requester
{
	public function send(Request $request): Response
	{
		$curl = curl_init();
		try
		{
			curl_setopt($curl, CURLOPT_VERBOSE, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $request->getMethod());
			curl_setopt($curl, CURLOPT_URL, $request->getUrl());

			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			// region I added these on a whim, don't know what they really impact.
			curl_setopt($curl, CURLOPT_AUTOREFERER, true);
			curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // To return the result.
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			// endregion

			$body = $request->getBody();
			curl_setopt($curl, CURLOPT_POST, null !== $body);
			if (null !== $body)
			{
				// TODO Support non-json bodies.
				$encodedBody = json_encode($body);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $encodedBody);
			}

			$headers = array_map(
				function (array $header) {
					return implode(':', $header);
				},
				$request->getHeaders()
			);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($curl);

			if (false === is_string($result)) {
				var_dump(curl_getinfo($curl));
			}
		}
		finally
		{
			curl_close($curl);
		}

		return new BasicResponse($result);
	}
}
