<?php
class AdminHomeController 
{
	public function __construct() {
		if (!auth()) {
			redirect('sign-in');
		}
	}

	public function dashboard() {
		return view('admin/dashboard');
	}

	function blogs() {
		return 'admin blogs';
	}
}