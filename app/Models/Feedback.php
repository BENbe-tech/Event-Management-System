<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [

        'comment',
        'event_user_id',
        'organizer_id'

    ];

    use HasFactory;
}
