<?php

declare(strict_types = 1);

namespace App\Charts;
use App\Models\Event;
use App\Models\EventUser;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Organizer;
use App\Models\User;

class EventChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */


    public function handler(Request $request): Chartisan
    {




        return Chartisan::build()
            ->labels(['Udicti hackthon', 'datatamasha', 'Huawei'])
            ->dataset('registered', [3, 2, 1])
            ->dataset('participants', [1, 2, 2]);
    }
}


