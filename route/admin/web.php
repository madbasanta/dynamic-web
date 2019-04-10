<?php
// admin routes
$controller = 'admin/AdminHomeController';

Route::get('/admin', 'admin/AdminHomeController@dashboard');
Route::get('/admin/events', 'admin/AdminHomeController@events');