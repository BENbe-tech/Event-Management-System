<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    public function feedbacks(){
     return $this->hasMany('App\Models\Feedback','organizer_id');

    }

    public function events(){
        return $this->hasMany('App\Models\Event','organizer_id');

       }

}
