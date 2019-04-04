<?php
require 'Controller.php';
_model('Enquiry');

class HomeController extends Controller
{
	// landing page
	function index() {
		return view('index');
	}

	// 404 page not found
	function page404() {
		return view('404');
	}

	// contact-us page
	function contactUs() {
		return view('contact-us');
	}
	// contact-us form submit function
	function saveEnquiry(Request $request) {
		$this->validateRequest($request);
		$enq = Enquiry::create($request->all());
		session(['message' => 'You message is submitted successfully.']);
		return redirect(session('http_previous_uri'));
	}

	private function validateRequest(Request $request) {
		$v = $this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			'phone' => 'required|numeric',
			'message' => 'required|min:10'
		]);
		if($v->hasInvalidField()) {
			session(['old' => $v->validated()]);
			session(['errors' => $v->bag()]);
			redirect(session('http_previous_uri'));
		}
	}

	function termsAndCondition() {
		return view('terms-and-condition');
	}
}