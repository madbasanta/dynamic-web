<?php

Route::get('sign-in', 'auth/LoginController@loginForm');

Route::post('sign-in', 'auth/LoginController@signIn');

Route::post('sign-up', 'auth/RegisterController@signUp');

Route::post('log-out', 'auth/LoginController@logout');