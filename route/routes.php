<?php

Route::get('/', 'HomeController@index');

Route::get('404-page-not-found', 'HomeController@page404');

Route::get('contact-us', 'HomeController@contactUs');

Route::get('location', 'HomeController@location');

Route::post('enquiry/save', 'HomeController@saveEnquiry');

Route::get('terms-and-condtions', 'HomeController@termsAndCondition');