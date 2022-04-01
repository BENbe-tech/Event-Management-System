<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [

        'message',
        'user_id',
        'event_id',
        'response_to_user_id',
        'create_ats'
    ];

    use HasFactory;


    public function events(){
        return $this->belongsTo(Event::class,'event_id');

       }


       public function users(){
        return $this->belongsTo(User::class,'user_id');

       }
}
