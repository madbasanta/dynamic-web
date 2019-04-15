<?php
_require('app/controllers/Controller.php');
_model('User');

class RegisterController extends Controller
{
	function __construct() {
		if(auth()) redirect(session('http_previous_uri'));
	}

	function signUp(Request $request) {
		$this->validateData($request);
		// debugger(session('http_previous_uri'));

		$cur_id = $this->generateCurId();

		$user = User::create([
			'cur_id' => $cur_id,
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'email' => $request->input('email'),
			'username' => $request->input(
				'the_username', 
				array_shift($username = explode('@', $request->input('email')))
			),
			'password' => sha1($request->input('password')),
		]);
		if($user) {
			session(['my_app_auth' => (object)$user->toArray()]);
			redirect('profile');
		}

		redirect(session('http_previous_uri'));
	}

	function generateCurId() {
		$max = User::select('max(cur_id) as last_cur_id')->first();
		$last_cur_id = $max ? $max->last_cur_id : 'CUR-000000';
		$int = explode('-', $last_cur_id);
		$int = array_pop($int);
		$cur_id = str_pad($int+1, 6, '0', STR_PAD_LEFT);
		return "CUR-$cur_id";
	}

	// validate request data
	function validateData(Request $request) {
		$validator = $this->validate($request, [
			'first_name' => 'required|string',
			'last_name' => 'required|string',
			'email' => 'required|email|unique:users,email',
			'the_username' => 'unique:users,username|username',
			'password' => 'confirmed:password_confirmation|min:8'
		]);
		if ($validator->hasInvalidField()) {
			session(['errors' => $validator->singleBag()]);
			session(['old' => $validator->validated()]);
			redirect(session('http_previous_uri'));
		}
	}
}