<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Many to many and one to mnay relationship for User
    public function organizers(){
        return $this->hasMany(Organizer::class,'user_id');

       }

       //Inerse many to many relationship
       public function events(){
        // return $this->belongsToMany('App\Models\Event','event_user');
        return $this->belongsToMany(Event::class, 'event_user','user_id','event_id');

      }

       //Inerse many to many relationship
       public function sessions(){
        // return $this->belongsToMany('App\Models\Event','event_user');
        return $this->belongsToMany(Session::class, 'session_user','user_id','session_id');

      }

      public function comments(){
        return $this->hasMany(Comment::class,'user_id');

       }



}
