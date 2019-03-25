<?php

Route::get('/', 'HomeController@index');

Route::get('404-page-not-found', 'HomeController@page404');

Route::get('about-us', 'HomeController@aboutUs');

// Route::get('test', 'HomeController@test');