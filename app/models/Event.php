<?php
_model('Model');

class Event extends Model
{
	protected $table = 'events';
	protected $fillable = ['slug', 'title', 'category', 'start_date', 'end_date', 'org', 'address_id', 'description'];
}