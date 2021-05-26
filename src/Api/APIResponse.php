<?php

namespace Epmnzava\MpesaTanzania\Api;

use Exception;

// API Response 
class APIResponse {
	
	var $status_code;
	var $headers;
	var $body;
	
	// Constructer
	public function __construct($status_code, $headers, $body) {
		$this->set_status_code($status_code);
		$this->set_headers($headers);
		$this->set_body($body);
	}
	

    public	function get_status_code() {
		return $this->status_code;
	}
	
	public function set_status_code($status_code) {
		if (gettype($status_code) != 'integer') {
			throw new Exception('status_code must be a integer');
		} else {
			$this->status_code = $status_code;
		}
	}
	
	public function get_headers() {
		return $this->headers;
	}
	
	public function set_headers($headers) {
		if (gettype($headers) != 'string') {
			throw new Exception('headers must be a string');
		} else {
			$this->headers = $headers;
		}
	}
	
    public	function get_body() {
		return $this->body;
	}
	
	public function set_body($body) {
		if (gettype($body) != 'string') {
			throw new Exception('body must be a string');
		} else {
			$this->body = $body;
		}
	}
}

