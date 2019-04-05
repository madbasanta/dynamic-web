<?php

Route::get('services', 'service/ServiceShowController@services');

Route::get('services/audio', 'service/ServiceShowController@audio');
Route::get('services/video', 'service/ServiceShowController@video');


Route::get('our-approach', 'service/ServiceShowController@trainings');