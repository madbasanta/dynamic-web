<?php
_require('app/controllers/Controller.php');
_model('User');

class LoginController extends Controller
{
	function __construct($method) {
		if(auth() && $method !== 'logout')
			redirect('/	');
	}

	// login form / page
	function loginForm() {
		$redirect_uri = '/';
		return view('auth/login', compact('redirect_uri'));
	}

	function signIn(Request $request) {
		// validate login request for username and password
		$this->validateRequest($request);
		$username = $request->input('username');
		$user = User::where([
			'password' => sha1($request->input('pwd'))
		])->where(DB::raw("(username = '$username' or email = '$username')"))
		->first();

		if($user) {
			/*
			check if user is login in from admin page and is really a admin if true opens dashboard
			if user is authenticated but not admin then redirects to home page
			*/
			if($request->input('page') === 'adminlogin' && !in_array($user->role, ['user'])) {
				session(['my_app_auth' => (object)$user->toArray()]);
				redirect('admin');
			} elseif ($request->input('page') === 'login') {
				session(['my_app_auth' => (object)$user->toArray()]);
				redirect('/');
			}
		}
		session(['errors' => ['username' => ['Username or password did not matched']]]);
		redirect(session('http_previous_uri'));
	}

	// Request validator
	function validateRequest(Request $request) {
		$validator = $this->validate($request, [
			'username' => 'required|exists_username:users,email,username',
			'pwd' => 'required'
		]);
		if($validator->hasInvalidField()) {
			session(['errors' => $validator->singleBag()]);
			session(['old' => $validator->validated()]);
			redirect(session('http_previous_uri'));
		}
	}

	function logout() {
		session()->forget('my_app_auth');
		redirect(session('http_previous_uri'));
	}

	function adminLogin() {
		return view('auth/adminLogin');
	}
}