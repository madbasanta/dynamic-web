<?php
_model('BaseModel');

class Model extends BaseModel
{
	static function __callStatic($method, $params) {
		$object = new static;
		$method = "_$method";
		if(method_exists($object, $method)) {
			return $object->$method(...$params);
		}
	}

	function __call($method, $params) {
		$method = "_$method";
		if(method_exists($this, $method)) {
			return $this->$method(...$params);
		}
	}
}