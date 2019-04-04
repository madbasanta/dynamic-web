<?php

class ServiceShowController
{
	function services() {
		return view('services/services');
	}

	// audio services
	function audio() {
		return view('services/audio');
	}

	// video services
	function video() {
		return view('services/video');
	}
}