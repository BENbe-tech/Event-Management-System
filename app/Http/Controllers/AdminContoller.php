<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class AdminContoller extends Controller
{
    //


    public function adminIndex(){


        return view('admin-dashboard');

    }


    public function adminSubscribers(){


        $user_id    = session('loginId');
        $subscriptions = Subscription::paginate(6);



        return view('admin-subscribers',compact('subscriptions'));
    }

    public function adminPayments(){



        $subscriptions = Subscription::paginate(6);



        return view('admin-payments',compact('subscriptions'));
    }

    public function adminOrganizers(){


        $organizers = Organizer::paginate(6);

        return view('admin-organizers',compact('organizers'));
    }



}
