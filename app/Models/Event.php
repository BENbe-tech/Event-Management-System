<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    public function eventDetail(){

        return $this->hasOne('App\Models\EventDetail','event_id');
    }

    public function ticket(){
        return $this->hasMany('App\Models\Ticket','event_id');

       }

       public function session(){
        return $this->hasMany('App\Models\Session','event_id');

       }

       public function user(){
         return $this->belongsToMany('App\Models\User');

       }
}
