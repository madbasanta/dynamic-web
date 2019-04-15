<?php

Route::get('services', 'service/ServiceShowController@services');

Route::get('services/audio', 'service/ServiceShowController@audio');
Route::get('services/video', 'service/ServiceShowController@video');


Route::get('services/{slug}', 'service/ServiceShowController@service');


Route::get('our-approach', 'service/ServiceShowController@trainings');


Route::get('events/list', 'service/ServiceShowController@eventList');


/*
addresses route
*/
Route::get('addresses/list', 'service/ServiceShowController@addressList');



/*
bookings
*/
Route::post('booking/events/{event}', 'service/ServiceShowController@eventBook');