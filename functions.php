<?php
// debugger function for testing variables
function debugger(...$args)
{
	echo '<pre>';
	foreach ($args as $arg)
		print_r($arg);
	echo '</pre>';
	exit;
}

// view returning functions
function view($path, $data = []) {
	extract($data);
	include('view/' . $path . '.php');
	session()->forget(['errors', 'old']);
}

$config = include('config.php');
// get config data
function config($key, $strip_tags = false) {
	global $config;
	if(isset($config[$key]))
		return !$strip_tags ? $config[$key] : strip_tags($config[$key]);
	return null;
}

// view include
function _include($path, $data = []) {
	extract($data);
	require 'view/' . $path . '.php';
}
function _require($path) {
	require_once $path;
}

// recursive file function
if ( ! function_exists('glob_recursive')) {
    // Does not support flag GLOB_BRACE        
   function glob_recursive($pattern, $flags = 0) {
		$dirs = glob($pattern . '/*', GLOB_ONLYDIR); 
		$files = [];
		foreach ($dirs as $dir)
			$files = array_merge($files, glob_recursive($dir));
		return array_merge($files, array_filter(glob($pattern . '/*'), 'is_file'));
   }
}

function session($key = 0, $default = null) {
	_require('app/Session.php');
	$setSession = is_array($key) ? true : false;
	if(!$setSession && $key) return call_user_func_array('Session::get', array($key, $default));
	// debugger($key);
	return $key === 0 ? new Session : call_user_func_array('Session::put', array($key));
}

// http request
function request() {
	global $request;
	return $request;
}

// change header location | redirect function
function redirect($uri) {
	header('location: /' . trim($uri, '/'));
	exit;
}

// check is it is exists in erro bag
function is_valid($key) {
	if(isset(session('errors')[$key])) 
		return 'is-invalid';
	if(old($key))
		return 'is-valid';
	return '';
}
// error message 
function error_msg($key) {
	$message = '';
	if(!isset(session('errors')[$key])) return $message;
	$errors = session('errors')[$key];
	$errors = is_array($errors) ? $errors : [$errors];
	foreach (session('errors')[$key] as $msg) {
		$msg = preg_replace('#_#', ' ', $msg);
		$message .= '<span class="text-danger">'.ucfirst($msg).'.</span>&nbsp;';
	}
	return $message;
}
// load old data from session 
function old($key) {
	return isset(session('old')[$key]) ? session('old')[$key] : null;
}

// require instance class of model
function _model($instance) {
	require_once "app/models/$instance.php";
}

// auth 
function auth($key = null) {
	$auth = session('my_app_auth');
	if(!$key) return $auth;
	if(isset($auth->$key))
		return $auth->$key;
	return null;
}