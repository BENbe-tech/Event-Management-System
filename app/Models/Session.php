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

}
