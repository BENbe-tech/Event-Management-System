<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'date',
        'start_time',
        'end_time',
        'online_link',
        'venue',
        'speaker',
        'document',
        'session_id'
    ];

    public function sessions(){

        return $this->belongsTo('App\Models\Session');
    }
}
