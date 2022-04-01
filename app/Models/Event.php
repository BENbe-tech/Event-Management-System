<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [

        'event_title',
        'organizer_id'

    ];
    //One to one, one to many and many to many relationship relationship for event model

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
        //  return $this->belongsToMany('App\Models\User','event_user');
         return $this->belongsToMany(User::class, 'event_user','event_id','user_id');

       }


       public function organizers(){
        return $this->belongsTo(Organizer::class,'organizer_id');

       }

       public function comments(){
        return $this->hasMany(Comment::class,'event_id');

       }

    }
