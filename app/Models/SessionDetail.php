<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionDetail extends Model
{
    use HasFactory;

    public function session(){

        return $this->belongsTo('App\Models\Session');
    }
}
