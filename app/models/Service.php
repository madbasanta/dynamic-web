<?php
_model('Model');

class Service extends Model
{
	protected $table = 'services';
	protected $fillable = ['slug', 'title', 'description', 'file_path', 'img_path'];
}