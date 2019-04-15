<?php
_require('app/controllers/Controller.php');
_model('Event');
_model('Address');
_model('Booking');
_model('User');

class AdminHomeController extends Controller
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

		return view('admin/events/events', compact('events'));
	}

	function createEvent() {
		return view('admin/events/create_form');
	}

	function saveEvent(Request $request) {
		$this->validateRequest($request);
		$hold = $request->all();
		$hold['slug'] = slug($request->input('title'));
		$event = Event::create($hold);
		if(!$event) {
			http_response_code(500);
		} else {
			http_response_code(201);
		}
	}

	function deleteEvent($event) {
		$count = Event::where(['id' => $event])->count();
		if($count) {
			Event::where(['id' => $event])->delete();
		} else {
			http_response_code(404);
		}
	}

	function editEventForm($id) {
		$event = Event::where(['id' => $id])->first();
		if ($event->address_id) {
			$event->address = Address::where(['id' => $event->address_id])->first();
		}
		return view('admin/events/edit_form', compact('event'));
	}

	function updateEvent(Request $request, $id) {
		$this->validateRequest($request);
		$hold = $request->all();
		$hold['slug'] = slug($request->input('title'));
		$statement = Event::where(['id' => $id])->update($hold);
		if(!$statement) {
			http_response_code(500);
		} else {
			http_response_code(200);
		}
	}


	private function validateRequest(Request $request) {
		$v = $this->validate($request, [
			'title' => 'required',
			'category' => 'required',
			'description' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
			'address_id' => 'required'
		]);
		if ($v->hasInvalidField()) {
			echo json_encode($v->singleBag());
			http_response_code(422);
			exit;
		}
	}



	/*

		attendies
	*/

	function bookings(Request $request) {
		$bookings = Booking::join('events', 'events.id', 'bookings.event_id')
						->select('bookings.*', 'events.title')
						->paginate(10);

		return view('admin/bookings/bookings', compact('bookings'));
	}

	/*

	users
	*/
	function users(Request $request) {
		$users = User::paginate(10);
		return view('admin/users/users', compact('users'));
	}
}