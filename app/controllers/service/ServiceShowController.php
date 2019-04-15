<?php
_require('app/controllers/Controller.php');
_model('Event', 'Address', 'User', 'Booking', 'Service');

class ServiceShowController extends Controller
{
	function services(Request $request) {
		$services = Service::orderBy('id', 'desc')->paginate(5);
		$audio_video = $this->getAudioVideo();
		return view('services/services', array_merge(compact('services'), $audio_video));
	}

	// single view
	function service($slug) {
		$service = Service::where(['slug' => $slug])->first();
		$audio_video = $this->getAudioVideo();
		return view('services/service', array_merge(compact('service'), $audio_video));
	}

	// audio services
	function audio(Request $request) {
		$services = Service::where(DB::raw('file_path like "%.mp3" or file_path like "%.aac"'))
						->orderBy('id', 'desc')->paginate(5);
		$audio_video = $this->getAudioVideo();
		return view('services/services', array_merge(compact('services'), $audio_video));
	}

	// video services
	function video() {
		$services = Service::where(DB::raw('file_path like "%.mp4" or file_path like "%.webm" or file_path like "%.flv"'))->orderBy('id', 'desc')->paginate(5);
		$audio_video = $this->getAudioVideo();
		return view('services/services', array_merge(compact('services'), $audio_video));
	}

	function getAudioVideo() {
		$audios = Service::where(DB::raw('file_path like "%.mp3" or file_path like "%.aac"'))
						->orderBy('id', 'desc')->limit(7)
						->json();
		$videos = Service::where(DB::raw('file_path like "%.mp4" or file_path like "%.webm" or file_path like "%.flv"'))
						->orderBy('id', 'desc')->limit(7)
						->json();
		return compact('audios', 'videos');
	}

	/*
		offerred trainings
	*/
	function trainings() {
		$trainings = Event::json();
		$pluck_trainings = json_decode(json_encode($trainings), true);
		$tr_ids = implode(',', array_column($pluck_trainings, 'id'));

		$addresses = Address::select('CONCAT(add1, ", ", city) as site', 'id')->where(DB::raw("id in ($tr_ids)"))->json();
		foreach ($trainings as $training) {
			foreach ($addresses as $addr) {
				if ($addr->id === $training->address_id) {
					$training->address = $addr;
					break;
				}
			}
		}
		return view('training/courses', compact('trainings'));
	}


	/*
	address list
	*/
	function addressList(Request $request) {
		$term = $request->input('term', '');
		return Address::select('id', 'CONCAT(add1, ", ", city) as text')
				->where(DB::raw("CONCAT(add1, \", \", city) like '%$term%'"))
				->json();
	}

	/*
	event list
	*/

	function eventList(Request $request) {
		$term = $request->input('term', '');
		return Event::select('events.slug as id', 'CONCAT(events.title, ", ", address.city) as text')
				->leftjoin('address', 'address.id', 'events.address_id')
				->where(DB::raw("title like '%$term%'"))
				->json();
	}



	
	/*

	event booking
	*/
	function eventBook(Request $request, $event_slug) {
		$this->validateBookingRequest($request);
		$user = User::where(['email' => $request->input('email')])->first();
		$data = $request->all();
		$event = Event::where(['slug' => $event_slug])->first();
		if($user) $data['user_id'] = $user_id;
		$data['event_id'] = $event->id;

		$booking = Booking::create($data);
		if($booking) {
			session(['booking_success' => 'You booking is reserved.']);
		} else {
			session(['booking_error' => 'Sorry ! You booking is not reserved.']);
		}

		redirect('location');
	}

	private function validateBookingRequest(Request $request) {
		if(!auth()) {
			redirect('sign-in');
		}
		$v = $this->validate($request, [
			'event' => 'required|exists:events,slug',
			'full_name' => 'required',
			'email' => 'required|email',
			'phone' => 'required|numeric',
			'booking_date' => 'required',
			'seat' => 'required|numeric'
		]);
		if($v->hasInvalidField()) {
			session(['errors' => $v->singleBag()]);
			session(['old' => $v->validated()]);
			redirect('location');
		}
	}
}