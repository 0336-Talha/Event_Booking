<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'location',
        'event_date',
        'total_seats',
        'available_seats',
        'created_by',
    ];
}
