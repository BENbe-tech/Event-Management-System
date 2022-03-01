<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;


public function sessionDetails(){

    return $this->hasOne('App\Models\SessionDetail','session_id');
}

}
