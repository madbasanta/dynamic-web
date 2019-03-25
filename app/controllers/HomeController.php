<?php
require 'Controller.php';

class HomeController extends Controller
{
	// landing page
	function index() {
		return view('index');
	}

	// 404 page not found
	function page404() {
		return view('404');
	}

	// about-us page
	function aboutUs() {
		return view('about-us');
	}

	function test() {
		return view('test');
	}
}