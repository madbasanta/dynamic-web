<?php
/*
* THIS IS THE REQUEST HANDLER INDEX
*/
session_start();
require 'functions.php';

require 'app/Router.php';
require 'app/Request.php';
$request = new Request();

// debugger($_SERVER);
Route::response(Request::method(), Request::uri());