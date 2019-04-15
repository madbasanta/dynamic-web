<?php
_require('app/controllers/Controller.php');
_model('User');

class PasswordResetController extends Controller
{
	public function form()
	{
		return view('auth/forget-password-form');
	}

	public function forgetPassword(Request $request)
	{
		session(['http_current_uri' => 'reset-password']);
		redirect('/reset-password');
	}

	/* password resets */
	public function resetForm()
	{
		return view('auth/password-reset-form');
	}

	public function resetPassword(Request $request)
	{
		$this->validateRequest($request);
		$user = User::where(['email' => $request->input('email')])->first();
		if($user) {
			User::where(['email' => $request->input('email')])->update([
				'password' => sha1($request->input('password'))
			]);
		}
		redirect('sign-in');
	}

	private function validateRequest(Request $request)
	{
		$v = $this->validate($request, [
			'email' => 'required|email|exists:users,email',
			'password' => 'required|password|confirmed:password_confirmation',
			'password_confirmation' => 'required'
		]);
		if($v->hasInvalidField()) {
			session(['old' => $v->validated()]);
			session(['errors' => $v->singleBag()]);
			redirect('reset-password');
		}
	}
}