<?php
_model('Model');

class User extends Model 
{
	protected $fillable = [
		'cur_id',
		'first_name', 
		'last_name', 
		'business_name', 
		'job_title', 
		'email', 
		'phone',
		'username',
		'password', 
		'profile_img'
	];
}