<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [

        'subscription_fee',
        'payment_date',
        'method',
        'reference_no',
        'subscription_end',
        'user_id',
        'phone_number',
        'subscription_type'
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id');

       }
}
