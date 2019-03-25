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
		$user = new User;
		$user = $user->save([
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'email' => $request->input('email'),
			'phone' => $request->input('phone'),
			'password' => sha1($request->input('password')),
		]);
		if($user) {
			session(['my_app_auth' => $user]);
			redirect('/');
		}
		redirect(session('http_previous_uri'));
	}

	// validate request data
	function validateData(Request $request) {
		$validator = $this->validate($request, [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users,email',
			'phone' => 'nullable|unique:users,phone|numeric',
			'password' => 'confirmed:password_confirmation|min:8'
		]);
		if ($validator->hasInvalidField()) {
			session(['errors' => $validator->bag()]);
			session(['old' => $validator->validated()]);
			redirect(session('http_previous_uri'));
		}
	}
}