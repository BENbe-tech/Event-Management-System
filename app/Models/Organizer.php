<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'email',
        'website_link',
        'facebook',
        'twitter',
        'instagram',
        'linkedIn',
        'user_id'

    ];

//One to many relationship for organizer
    public function feedbacks(){
     return $this->hasMany('App\Models\Feedback','organizer_id');

    }

    public function events(){
        return $this->hasMany('App\Models\Event','organizer_id');

       }
//Inverse one to many relationship

       public function users(){
        return $this->belongsTo(User::class,'user_id');
       }

}
