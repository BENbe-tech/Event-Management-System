<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Models\EventDetail;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/', function () {

    $event_categorys =Category::all();
    $events = Event::all();
    $IDevents = Event::all()->pluck('id');
    $eventsdetails = $event_details =EventDetail::all()-> whereIn('event_id',$IDevents);
    $count = $events->count();
    if($count== 0){
        $flag = 0;
    }
    else{
        $flag = 1;
    }


    return view('home',compact('event_categorys','events','IDevents','flag'));
    // return view('welcome');

});


Route::get('/home',[HomeController::class,'index'])->name('home');
