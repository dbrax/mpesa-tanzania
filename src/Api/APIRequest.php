<?php

namespace Epmnzava\MpesaTanzania\Api;

use Exception;
use phpseclib\Crypt\RSA;


// Creates the API Request from the context
class APIRequest
{

	var $context;

	// Constructer context
	public function __construct($context)
	{
		if ($context != null && get_class($context) != 'APIContext') {
			throw new Exception('Input must be an APIContext');
		}
		$this->context = $context;
	}

	// Does the HTTP Request
	public function execute()
	{
		if ($this->context == null) {
			throw new Exception('Context cannot be null');
		}
		$this->create_default_headers();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);

		switch ($this->context->get_method_type()) {
			case APIMethodType::GET:
				return $this->__get($ch);
			case APIMethodType::POST:
				return $this->__post($ch);
			case APIMethodType::PUT:
				return $this->__put($ch);
			default:
				return null;
		}
	}

	// Creates the Authorisation bearer token using the RSA public key provided
	public function create_bearer_token()
	{
		// Need to do these lines to create a 'valid' formatted RSA key for the openssl library


		$rsa =  new RSA();
		$rsa->loadKey($this->context->get_public_key());
		$rsa->setPublicKey($this->context->get_public_key());
		$publickey = $rsa->getPublicKey();
		$api_encrypted = '';
		$encrypted = '';

		if (openssl_public_encrypt($this->context->get_api_key(), $encrypted, $publickey)) {
			$api_encrypted = base64_encode($encrypted);
		}
		return $api_encrypted;
	}

	// Add the default headers
	public function create_default_headers()
	{
		$this->context->add_header('Authorization', 'Bearer ' . $this->create_bearer_token());
		$this->context->add_header('Content-Type', 'application/json');
		$this->context->add_header('Host', $this->context->get_address());
	}

	// Do a GET request
	public function __get($ch)
	{
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		$params = '';
		foreach ($this->context->get_parameters() as $key => $value) {
			$params .= $key . '=' . $value . '&';
		}
		$params = trim($params, '&');

		curl_setopt($ch, CURLOPT_URL, $this->context->get_url() . '?' . $params);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->context->get_headers());
		$response = curl_exec($ch);

		echo $response;
		echo '<br>';
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$headers = substr($response, 0, $header_size);
		$body = substr($response, $header_size);
		curl_close($ch);
		return new APIResponse($status_code, $headers, $body);
	}

	// Do a POST request
	public function __post($ch)
	{
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_URL, $this->context->get_url());
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->context->get_headers());
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->context->get_parameters()));
		$response = curl_exec($ch);
		echo $response;
		echo '<br>';
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$headers = substr($response, 0, $header_size);
		$body = substr($response, $header_size);
		curl_close($ch);
		return new APIResponse($status_code, $headers, $body);
	}

	// Do a PUT request
	public function __put($ch)
	{
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_URL, $this->context->get_url());
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->context->get_headers());
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->context->get_parameters()));
		$response = curl_exec($ch);
		echo $response;
		echo '<br>';
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$headers = substr($response, 0, $header_size);
		$body = substr($response, $header_size);
		curl_close($ch);
		return new APIResponse($status_code, $headers, $body);
	}

	public function __unknown()
	{
		throw new Exception('Unknown method');
	}
}
