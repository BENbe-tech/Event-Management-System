<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\Report;

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
        $email = "EMAIL";
        $report = Report::find(1);
        $report->event_id = $this->event_id;
        $report->update();

        return Report::all()->where('event_id',$this->event_id);
        // return $participants;
    }
}
