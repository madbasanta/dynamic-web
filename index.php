<?php
/*
* THIS IS THE REQUEST HANDLER INDEX
*/
// session_write_close();
require_once('app/Session.php');
session_start();
// session_destroy();
require 'functions.php';

require 'app/Router.php';
require 'app/Request.php';
$request = new Request();

// debugger($_SERVER);
Route::response(Request::method(), Request::uri());