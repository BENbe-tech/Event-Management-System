<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'event_id',
        'event_user_id',
        'payment_id'

    ];

    public function payments(){

        return $this->belongsTo('App\Models\Payment');
    }
}
