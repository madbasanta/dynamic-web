<?php
_require('app/ValidationRule.php');

class Validator
{
	use ValidationRule;

	private $bag = [];
	private $valid = [];
	public $request;
	private $nullables = [];

	function __construct() {

	}

	static function validate(Request $request, $rules = [], $messages = []) {
		$v = new static;
		$v->request = $request;
		$v->validateRules($rules, $messages);
		return $v;
	}

	function validateRules($rules, $messages) {
		$rules = array_map(function($rule) {
			return explode('|', $rule);
		}, $rules);
		foreach ($rules as $key => $rule) {
			$this->validateKey($key, $rule, isset($messages[$key])?:null);
		}
	}

	function validateKey($key, $rules, $messages) {
		foreach($rules as $rule):
			$rule = explode(':', $rule);
			$the_rule = $rule[0];
			$params = isset($rule[1]) ? $rule[1] : null;
			if($bag = $this->$the_rule($key, $params)) {
				is_array($bag) 
				? $this->put($key, (isset($messages[$key])?$messages[$key]
				: $bag['message'])) : $this->valid($key, $this->request->input($key));
			}
		endforeach;
	}
	
	function valid($key, $value) {
		$this->valid[$key] = $value;
	}
	function put($key, $message) {
		$this->bag[$key] = $message;
	}
	function hasInvalidField() {
		return count($this->bag);
	}
	function bag() {
		return $this->bag;
	}
	function validated() {
		return $this->valid;
	}
	function null($key) {
		$this->nullables[] = $key;
	}
}