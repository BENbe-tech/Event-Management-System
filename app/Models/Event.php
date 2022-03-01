<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    public function eventDetails(){

        return $this->hasOne('App\Models\EventDetail','event_id');
    }

    public function tickets(){
        return $this->hasMany('App\Models\Ticket','event_id');

       }

       public function sessions(){
        return $this->hasMany('App\Models\Session','event_id');

       }

       public function users(){
         return $this->belongsToMany('App\Models\User');

       }
}
