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
        'speaker_profile',
        'event_id'

    ];

    //Inverse relation for eventdetail with event one to one relationship

    public function events(){

        return $this->belongsTo('App\Models\Event','event_id');
    }
}
