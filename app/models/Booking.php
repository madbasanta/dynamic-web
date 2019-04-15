<?php
_model('Model');

/**
 * booking model
 */
class Booking extends Model
{
	protected $table = 'bookings';

	protected $fillable = ['full_name', 'email', 'phone', 'booking_date', 'user_id', 'event_id', 'seat'];
}