<?php
_require('app/Validator.php');
// base controller
class Controller
{
	protected function validate(Request $request, $rules = [], $messages = []) {
		return Validator::validate($request, $rules, $messages);
	}
}