<?php

class Request
{
	private $GET = [];
	private $POST = [];
	private $SERVER;
	private $params = [];

	function __construct() {
		$this->GET = $_GET;
		$this->POST = $_POST;
		$this->SERVER = $_SERVER;
	}

	function all() {
		return array_merge($this->GET, $this->POST);
	}

	function input($key, $default = null) {
		if (isset($this->GET[$key])) {
			return $this->GET[$key];
		}
		if (isset($this->POST[$key])) {
			return $this->POST[$key];
		}
		return $default;
	}

	function getMethod() {
		return $this->SERVER['REQUEST_METHOD'];
	}
	function getUri() {
		return preg_replace('#\?.*#', '', $this->SERVER['REQUEST_URI']);
	}

	static function method() {
		return request()->getMethod();
	}

	static function uri() {
		return request()->getUri();
	}
}