

<?php
_model('Model');

trait ValidationRule
{
	function required($key, $params = null) {
		if (!trim($this->request->input($key))) {
			return ['message' => $key . ' is required'];
		}
		return true;
	}
	function confirmed($key, $params) {
		if($this->is_nullable($key))
			return true;
		$params = $params ? explode(',', $params) : [];
		foreach($params as $arg) {
			if($this->request->input($key) !== $this->request->input($arg)) 
				return ['message' => $key . ' is not equal with ' . $arg];
		}
		return true;
	}
	function password($key, $params) {
		if($this->is_nullable($key))
			return true;
		$value = $this->request->input($key);
		if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#\$%\^&])(?=.{6,})/', $value)) {
			return true;
		}
		$message = ['message' => $key . ' is not valid password'];
		if(!preg_match('/[A-Z]+/', $value)) {
			$message = ['message' => 'The string must contain at least 1 uppercase alphabetical character'];
		} else if(!preg_match('/[a-z]+/', $value)) {
			$message = ['message' => 'The string must contain at least 1 lowercase alphabetical character'];
		} else if(!preg_match('/[0-9]+/', $value)) {
			$message = ['message' => 'The string must contain at least 1 numeric character'];
		} else if(!preg_match('/[!@#\$%\^&]+/', $value)) {
			$message = ['message' => 'The string must contain at least one special character such as !, @, #, $, %, ^, &'];
		} else if(!preg_match('/.{6,}/', $value)) {
			$message = ['message' => 'The string must be six characters or longer'];
		}
		return $message;
	}
	function min($key, $params) {
		if($this->is_nullable($key))
			return true;
		$value = $this->request->input($key);
		if(is_numeric($value) && (float) $value < $params) {
			return ['message' => $key . ' must be greater than '. $params];
		}
		if(strlen($value) < $params) {
			return ['message' => $key . ' length must be more than ' . $params . ' character'];
		}
		return true;
	}
	function email($key, $params) {
		if($this->is_nullable($key))
			return true;
		if (!filter_var($this->request->input($key), FILTER_VALIDATE_EMAIL)) {
		  	return ['message' => $key . ' must be a valid email address'];
		}
		return true;
	}
	function unique($key, $params) {
		if($this->is_nullable($key))
			return true;
		$params = explode(',', $params);
		$table = $params[0];
		$column = isset($params[1]) ? $params[1] : $key;
		$d = Model::table($table)->where([$column => $this->request->input($key)])->first();
		if ($d) {
			return ['message' => $key . ' is already taken'];
		}
		return true;
	}
	function string($key) {
		if($this->is_nullable($key))
			return true;
		if(preg_match('#^[a-zA-Z ]+$#', $this->request->input($key))) {
			return true;
		}
		return  ['message' => $key . ' must be an valid string'];
	}
	function numeric($key) {
		if($this->is_nullable($key))
			return true;
		if(is_numeric($this->request->input($key))) return true;
		return ['message' => $key . ' must be an valid numeric value'];
	}
	function exists($key, $params) {
		$params = explode(',', $params);
		$column = isset($params[1]) ? $params[1] : $key;
		$table = $params[0];
		$d = Model::table($table)->where([$column => $this->request->input($key)])->first();
		if (!$d) {
			return ['message' => $key . ' doesn\'t exists'];
		}
		return true;
	}
	function nullable($key) {
		$this->null($key);
		return true;
	}
	function is_nullable($key) {
		if(!$this->request->input($key) && in_array($key, $this->nullables))
			return true;
	}

	function exists_username($key, $params) {
		$params = explode(',', $params);
		$table = array_shift($params);
		$username = $this->request->input($key);
		$exp = array_reduce($params, function($acc, $exp) use($username) {
			return $acc .= " $exp = '$username' or";
		}, '');
		// dd($exp, $table);
		$d = Model::table($table)->where(DB::raw(rtrim($exp, 'or')))->first();
		if (!$d) {
			return ['message' => $key . ' doesn\'t exists'];
		}
		return true;
	}

	function username($key) {
		if (preg_match('!^[a-zA-Z0-9]{5,}$!', $this->request->input($key))) {
			return true;
		}
		return ['message' => 'Username can not contain empty space or symbols'];
	}
}