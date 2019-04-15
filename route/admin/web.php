<?php
// admin routes

Route::get('admin', 'admin/AdminHomeController@dashboard');


/*
events route
*/
Route::get('admin/events', 'admin/AdminHomeController@events');
Route::get('admin/events/create', 'admin/AdminHomeController@createEvent');
Route::post('admin/events/save', 'admin/AdminHomeController@saveEvent');
Route::post('admin/events/{event}/delete', 'admin/AdminHomeController@deleteEvent');
Route::get('admin/events/{event}/edit', 'admin/AdminHomeController@editEventForm');
Route::post('admin/events/{event}/update', 'admin/AdminHomeController@updateEvent');
/*
services route
*/
Route::get('admin/services', 'admin/AdminServiceController@services');
Route::get('admin/services/create', 'admin/AdminServiceController@createService');
Route::post('admin/services/save', 'admin/AdminServiceController@saveService');
Route::post('admin/services/{service}/delete', 'admin/AdminServiceController@deleteService');
Route::get('admin/services/{service}/edit', 'admin/AdminServiceController@editServiceForm');
Route::post('admin/services/{service}/update', 'admin/AdminServiceController@updateService');




/*
	bookings
*/
Route::get('admin/bookings', 'admin/AdminHomeController@bookings');


/*
	users
*/
Route::get('admin/users', 'admin/AdminHomeController@users');