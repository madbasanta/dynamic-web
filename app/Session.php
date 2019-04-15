<?php
class Session
{
	private $sessions = array();

	function __construct($args = []) {
		$this->sessions = isset($_SESSION['app']) ? $_SESSION['app'] : [];
		$this->_put($args);
	}

	// put value on session statically
	static function put($arg1, $arg2 = null) {
		$value = is_array($arg1) ? $arg1 : [$arg1 => $arg2]; 
		return new static($value);
	}

	// get access to session statically
	static function get($key, $default) {
		$sessions = new static;
		return $sessions->_get($key, $default);
	}

	// put new value in session object
	private function _put($args) {
		foreach($args as $key => $value) {
			$this->sessions[$key] = $value;
			$_SESSION['app'][$key] = $value;
		}
	}

	// get session value from the object
	private function _get($key, $default) {
		return isset($_SESSION['app'][$key]) && isset($this->sessions[$key]) ? $this->sessions[$key] : $default;
	}

	// call forget method 
	function forget($key) {
		$keys = is_array($key) ? $key : func_get_args();
		return $this->_forget($keys);
	}

	// remove value from session
	private function _forget($keys) {
		foreach($keys as $key)
			unset($_SESSION['app'][$key]);
		return new static;
	}

	// flush all sessions
	function flush() {
		unset($_SESSION['app']);
		return new static;
	}
}