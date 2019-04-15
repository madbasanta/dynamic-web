<?php
_require('app/controllers/Controller.php');
_model('User', 'Model', 'Event');

class UserController extends Controller
{
	public function __construct($method) {
		if(!auth()) {
			redirect('/');
		}
	}

	function profile() {
		$user = User::where(['id' => auth('id')])->first();
		// dd($user);
		$interests = Model::table('user_interests')->select('title', 'id')
					->where(['user_id' => auth('id')])
					->limit(7)
					->json();

		$has_interest = count($interests) > 0;

		if(!$has_interest)
			$interests = Event::select('DISTINCT category')->json();

		return view('user-profile', compact('user', 'interests', 'has_interest'));
	}


	/*
		save interests
	*/
	function saveInterests(Request $request) {
		$user_id = auth('id');
		foreach ($request->input('interests', []) as $value) {
			$m = Model::table('user_interests');
			$m->title = $value;
			$m->user_id = $user_id;
			$m->save();
		}
		redirect('profile');
	}

	function changeForm() {
		$my_interests = Model::table('user_interests')->select('title as category')
					->where(['user_id' => auth('id')])
					->fetch();
					
		// $my_interests = json_decode(json_encode($my_interests), true) ?: [];
		$my_interests = array_column($my_interests, 'category');

		$interests = Event::select('DISTINCT category')->json();

		return view('inc/interest-change-form', compact('my_interests', 'interests'));
	}

	function updateInterests(Request $request) {
		Model::table('user_interests')->where(['user_id' => auth('id')])->delete();
		$this->saveInterests($request);
	}


	/*
	edit profile info
	*/
	function editProfileInfo() {
		$user = User::where(['id' => auth('id')])->first()->toArray();

		if(!session('old')):
			session(['old' => $user]);
		endif;

		return view('inc/profile-edit-form', compact('user'));
	}

	// save profile info
	function saveProfileInfo(Request $request) {
		$this->validateProfileRequest($request);

		$data = $request->all();
		if($request->has('password')) {
			$this->validateProfileRequest($request, [
				'password' => 'confirmed:password_confirmation|min:8'
			]);

			$data = array_merge($data, [
				'password' => sha1($request->input('password'))
			]);
		}

		if($request->hasFile('profile_img')) {
			$original_name = $request->file('profile_img')->original_name();
			$file_path = $request->move('assets/img/users', str_pad(auth('id'), 2, '0', STR_PAD_LEFT) . $original_name);
			$data['profile_img'] = $file_path ?: null;
		}

		User::where(['id' => auth('id')])->update($data);

		session(['my_app_auth' => (object)User::where(['id' => auth('id')])->first()->toArray()]);

		redirect('profile');
	}

	function validateProfileRequest(Request $request, $fields = null) {
		$validator = $this->validate($request, $fields?:[
			'first_name' => 'required|string',
			'last_name' => 'required|string',
			'email' => 'required|email',
			'phone' => 'nullable|numeric',
			'business_name' => 'nullable',
			'job_title' => 'nullable'
		]);
		if ($validator->hasInvalidField()) {
			session(['errors' => $validator->singleBag()]);
			session(['old' => $validator->validated()]);
			redirect('profile/edit');
		}
	}
}