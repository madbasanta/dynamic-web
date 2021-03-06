<?php

class App
{
	public static function call($controller, $method, $data = [])
	{
		_require('app/controllers/' . $controller . '.php');
		$controller = basename($controller);

		$handler = new $controller($method);
		if (!method_exists($handler, $method)) {
			http_response_code(500);
			throw new Exception("Bad method call");
		}
		$reflection = new ReflectionMethod($controller, $method);
		$arguments = [];
		$data = array_values($data);
		foreach ($reflection->getParameters() as $key => $arg) {
			if($arg->getClass() && $arg->getClass()->name === 'Request') {
				$arguments[$key] = request();
			} else {
				$arguments[$key] = array_shift($data);
			}
		}
		// $response = call_user_func_array("$controller::$method", $arguments);
		$response = $handler->$method(...$arguments);
		// $response = $handler->$method(...array_values($data));
		if (is_array($response) || is_object($response)) echo json_encode($response);
		elseif (is_string($response) || is_numeric($response)) echo $response;
		elseif (is_bool($response)) echo $response ? '1' : '0';
		elseif (is_null($response)) echo $response;
	}
}