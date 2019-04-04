<?php
_model('Model');

class Enquiry extends Model
{
	protected $table = 'enquiries';

	protected $fillable = ['name', 'email', 'phone', 'message'];
}