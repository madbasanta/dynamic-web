<?php
_require('app/App.php');

class Route
{
	private static $routes = array(
		'GET' => [], 
		'POST' => [], 
		'WILDCARD' => array('GET' => [], 'POST' => [])
	);

	public function __construct() {
		foreach(glob_recursive('route') as $route)
			_require($route);

		// just for current or previos page
		$uri = session('http_current_uri');
		$request_uri = trim($_SERVER['REQUEST_URI'], '/');
		if($uri !== $request_uri)
		session([
			'http_current_uri' => $request_uri,
			'http_previous_uri' => $uri
		]);
	}

	public static function getPregUri($uri, $method = 'GET') {
		$uri = trim($uri, '/');
		$preg_uri = '#^' . preg_replace('#{[a-z]*}#', '[-a-z0-9]+', $uri) . '$#'; // replace all wildcards with preg
		if (preg_match_all('#{[a-z]*}#', $uri, $matches)) {
			static::$routes['WILDCARD'][$method][$preg_uri] = $uri; // set old uri as wildcard reference
		}
		return $preg_uri;
	}

	public static function response($method, $uri) {
		$router = new static;
		$callback = function ($path, $data = []) {
			list($class, $method) = explode('@', $path);
			if (!isset($method)) throw new Exception("Bad method call");
			call_user_func_array('App::call', array($class, $method, $data));
		};
		$uri = trim($uri, '/');
		foreach (static::$routes[$method] as $key => $value) {
			if (!preg_match($key, $uri, $matches))
				continue;
			if (!isset(static::$routes['WILDCARD'][$method][$key]))
				return $callback(static::$routes[$method][$key]);
			return $callback(static::$routes[$method][$key], array_diff(
				explode('/', $uri), explode('/', static::$routes['WILDCARD'][$method][$key])
			));
		}
		session(['http_current_uri' => '404-page-not-found']);
		!request()->input('ajax') ? redirect('404-page-not-found') : null;
		exit;
	}

	// store get request route in static $routes['GET']
	public static function get($uri, $controller) {
		$uri = static::getPregUri($uri); // get the preg uri for wildcard
		static::$routes['GET'][$uri] = $controller;
	}
	// store post request route in static $routes['POST']
	public static function post($uri, $controller) {
		$uri = static::getPregUri($uri, 'POST'); // get the preg uri for wildcard
		static::$routes['POST'][$uri] = $controller;
	}
}