<?php
class AdminHomeController 
{
	public function __construct() {
		if (!auth() || auth('role') === 'user') {
			redirect('admin/login');
		}
	}

	public function dashboard() {
		return view('admin/dashboard1');
	}

	function blogs() {
		return 'admin blogs';
	}
}