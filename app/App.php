<?php

class App
{
	public static function call($controller, $method, $data = [])
	{
		_require('app/controllers/' . $controller . '.php');
		$controller = basename($controller);

		$handler = new $controller($method);
		if (!method_exists($handler, $method)) {
			throw new Exception("Bad method call");
		}
		$reflection = new ReflectionMethod($controller, $method);
		$arguments = [];
		$data = array_values($data);
		foreach ($reflection->getParameters() as $key => $arg) {
			if($arg->getClass() && $arg->getClass()->name === 'Request') {
				$arguments[$key] = request();
			} else {
				$arguments[$key] = isset($data[$key]) ? $data[$key] : null;
			}
		}
		// $response = call_user_func_array("$controller::$method", $arguments);
		$response = $handler->$method(...$arguments);
		// $response = $handler->$method(...array_values($data));
		if (is_array($response)) echo json_encode($response);
		if (is_string($response)) echo $response;
		if (is_bool($response)) echo $response ? '1' : '0';
	}
}