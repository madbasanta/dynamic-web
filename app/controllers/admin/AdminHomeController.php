<?php
_model('Event');

class AdminHomeController 
{
	public function __construct() {
		if (!auth() || auth('role') === 'user') {
			redirect('admin/login');
		}
	}

	public function dashboard() {
		return view('admin/dashboard');
	}

	function events(Request $request) {
		$events = Event::leftjoin('address', 'address.id', 'events.address_id')
					->select('events.*', 'city')->paginate(10);
					// debugger($events);
		return view('admin/events/events', compact('events'));
	}
}