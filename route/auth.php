<?php

Route::get('sign-in', 'auth/LoginController@loginForm');

Route::post('sign-in', 'auth/LoginController@signIn');

Route::post('sign-up', 'auth/RegisterController@signUp');

Route::post('log-out', 'auth/LoginController@logout');
//=======================================================================

/*
	ADMIN AUTH
*/
Route::get('admin/login', 'auth/LoginController@adminLogin');
Route::post('admin/sign-in', 'auth/LoginController@signIn');


/*
	FORGET PASSWORD
*/

Route::get('forget-password', 'auth/PasswordResetController@form');
Route::post('forget-password', 'auth/PasswordResetController@forgetPassword');

Route::get('reset-password', 'auth/PasswordResetController@resetForm');
Route::post('reset-password', 'auth/PasswordResetController@resetPassword');


