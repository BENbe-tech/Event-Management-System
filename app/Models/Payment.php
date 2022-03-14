<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [

        'payment_time',
        'amount',
        'method'
    ];
     //One to one relatioship for between payment and ticket

    public function tickets(){

        return $this->hasOne('App\Models\Ticket','payment_id');
    }
}
