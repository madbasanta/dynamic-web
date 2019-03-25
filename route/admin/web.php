<?php
// admin routes
$controller = 'admin/AdminHomeController';

Route::get('/admin', join('@', [$controller, 'dashboard']));
Route::get('/admin/blogs', join('@', [$controller, 'blogs']));