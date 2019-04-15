<?php

Route::get('profile', 'UserController@profile');

Route::post('user-interests/save', 'UserController@saveInterests');

Route::get('user-interests/change', 'UserController@changeForm');

Route::post('user-interests/update', 'UserController@updateInterests');

Route::get('profile/edit', 'UserController@editProfileInfo');

Route::post('profile/save', 'UserController@saveProfileInfo');

