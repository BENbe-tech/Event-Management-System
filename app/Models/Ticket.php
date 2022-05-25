<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode_no',
        'reference_no',
        'amount',
        'event_id',
        'user_id'

    ];
       //Inverse relationship between Ticket and payment
    // public function payments(){

    //     return $this->belongsTo('App\Models\Payment','payment_id');
    // }

    public function users(){
        return $this->belongsTo(User::class,'user_id');

       }

       public function events(){
        return $this->belongsTo(Event::class,'event_id');

       }


}
