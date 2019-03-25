<?php
_require('app/controllers/Controller.php');
_model('User');

class LoginController extends Controller
{
	function __construct($method) {
		if(auth() && $method !== 'logout')
			redirect(session('http_previous_uri'));
	}

	// login form / page
	function loginForm() {
		$redirect_uri = '/';
		return view('auth/login', compact('redirect_uri'));
	}

	function signIn(Request $request) {
		// validate login request for username and password
		$this->validateRequest($request);
		$user = new User();
		$user = $user->where([
			'email' => $request->input('username'), 
			'password' => sha1($request->input('pwd'))
		])->first();
		if($user) {
			session(['my_app_auth' => $user]);
			redirect('/');
		}
		session(['errors' => ['username' => 'Username or password did not matched.']]);
		redirect(session('http_previous_uri'));
	}

	// Request validator
	function validateRequest(Request $request) {
		$validator = $this->validate($request, [
			'username' => 'required',
			'pwd' => 'required'
		]);
		if($validator->hasInvalidField()) {
			session(['errors' => $validator->bag()]);
			session(['old' => $validator->validated()]);
			redirect(session('http_previous_uri'));
		}
	}

	function logout() {
		session()->forget('my_app_auth');
		redirect(session('http_previous_uri'));
	}
}