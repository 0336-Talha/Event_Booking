<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\User;



class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'event_id',
        'seats_booked',
        'status',
        'booking_date',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
