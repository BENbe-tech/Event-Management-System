<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Event;
use App\Models\EventUser;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $event_id;

      function __construct($event_id) {
       $this->event_id = $event_id;
      }


    public function collection()
    {
        $event = Event::find($this->event_id);
        $participants = EventUser::all()->where('event_id',$this->event_id);

        // return User::all();
        return $participants;
    }
}
