<?php

class BlogShowController
{
	function blogs() {
		return view('blog/blogs');
	}

	function show($slug = null) {
		if (!$slug) {
			header('location: /blogs');
		}
		return $slug;
	}

	// courses
	function courses() {
		return view('course/courses');
	}
}