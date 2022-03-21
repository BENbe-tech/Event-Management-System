<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'event_id'

    ];

    //One to one relatioship between session and sessioDetail
public function sessionDetails(){

    return $this->hasOne('App\Models\SessionDetail','session_id');
}

public function users(){
    //  return $this->belongsToMany('App\Models\User','event_user');
     return $this->belongsToMany(User::class, 'session_user','session_id','user_id');

   }

   public function event(){
    return $this->belongsTo(Event::class,'event_id');

   }


}
