<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;

class ApiController extends Controller
{
    //

    public function Users(){

        $users =User::all();

        return response()->json($users);


    }

}
