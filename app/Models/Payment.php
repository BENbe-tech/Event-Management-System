<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function ticket(){

        return $this->hasOne('App\Models\Ticket','payment_id');
    }
}
