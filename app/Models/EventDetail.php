<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
    use HasFactory;

    protected $fillable = [

        'category',
        'online_link',
        'venue',
        'city',
        'address',
        'starttime',
        'endtime',
        'price',
        'description',
        'image_name',
        'image_path',
        'document_name',
        'document_path',
        'entry_mode',
        'speaker',
        'event_id'

    ];


    public function events(){
     
        return $this->belongsTo('App\Models\Event','event_id');
    }
}
