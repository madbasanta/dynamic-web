<?php

class Request
{
	private $REQUEST;
	private $FILES;
	private $SERVER;
	private $params = [];
	private $current_file;

	function __construct() {
		$this->REQUEST = $_REQUEST;
		$this->FILES = $_FILES;
		$this->SERVER = $_SERVER;
	}

	function all() {
		return array_merge($this->REQUEST, $this->FILES);
	}

	function has($key) {
		return array_key_exists($key, $this->REQUEST);
	}

	function hasFile($key) {
		if (array_key_exists($key, $this->FILES)) {
			if (is_array($arr = $this->FILES[$key]['error'])) {
				return array_reduce($arr, function($a, $v) {
					return $a ? $v == 0 : false;
				}, true);
			}
			return $arr == 0;
		}
		return false;
	}

	function input($key, $default = null) {
		if (isset($this->REQUEST[$key]) && $this->REQUEST[$key]) {
			return $this->REQUEST[$key];
		}
		return $default;
	}

	function file($key) {
		$this->current_file = $this->FILES[$key];
		return $this;
	}

	function original_name() {
		return $this->current_file['name'];
	}

	function count() {
		return is_array($this->current_file['name'])?count($this->current_file['name']):0;
	}

	function move($path, $filename = false) {
		$item = isset($this->current_file) ? $this->current_file : false;
		if(!$item) {
			http_response_code(500);
			throw new Exception("Cannot use move function. Select file first.");
		}

		if(!file_exists($path) && !is_dir($path)) {
			mkdir($path, 0735);
		}
		
		$file_name = $filename ? join('/', func_get_args()) : $path .'/'. $item['name'];
		$response = move_uploaded_file($item['tmp_name'], $file_name) ? $file_name : false;
		$this->current_file = null;
		return $response;
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