<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'participant',
        'email',
        'verified_attendance',
        'attendance_mode',
        'payment_amount',
        'ticket_number'
    ];

    protected $hidden = ['id', 'created_at', 'updated_at','event_id','event_title'];
}
