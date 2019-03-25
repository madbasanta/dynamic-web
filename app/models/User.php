<?php
_model('Model');

class User extends Model 
{
	protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'password'];
}