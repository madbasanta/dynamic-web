<?php
$controller = 'blog/BlogShowController';

Route::get('blogs', join('@', [$controller, 'blogs']));
Route::get('blogs/{slug}', join('@', [$controller, 'show']));