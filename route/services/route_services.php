<?php

Route::get('services', 'service/ServiceShowController@services');

Route::get('services/audio', 'services/ServiceShowController@audio');
Route::get('services/video', 'services/ServiceShowController@video');