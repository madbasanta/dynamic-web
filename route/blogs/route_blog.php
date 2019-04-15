<?php

Route::get('blogs', 'blog/BlogShowController@blogs');
Route::get('blogs/{slug}', 'blog/BlogShowController@show');

Route::get('courses', 'blog/BlogShowController@courses');
