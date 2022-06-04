<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Models\EventDetail;
use App\Models\Category;
use App\Http\Controllers\ApiController;

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






Route::get('/users',[ApiController::class,'Users'])->name('users');

Route::get('/user/{id}',[ApiController::class,'User'])->name('user');


Route::get('/events',[ApiController::class,'Events'])->name('events');


Route::get('/event/{id}',[ApiController::class,'Event'])->name('event');


Route::get('/eventdetails',[ApiController::class,'Eventdetails'])->name('eventdetails');


Route::get('/eventdetail/{id}',[ApiController::class,'Eventdetail'])->name('eventdetail');




Route::post('/register-user',[ApiController::class,'registerUser'])->name('register-user');



Route::post('login-user',[ApiController::class,'loginUser'])->name('login-user');



Route::get('/logout/{session_key}',[ApiController::class,'logout'])->name('logout');


//create event
Route::post('/create-event1',[ApiController::class,'createEvent'])->name('create-event1');


// register in event
Route::get('/participants/{event_id}/{user_id}',[ApiController::class,'participants'])->name('participants');


//create session
Route::post('/create-session1',[ApiController::class,'createSession'])->name('create-session1');

//register in session
Route::get('/session-participants/{event_id}/{user_id}/{session_id}',[ApiController::class,'sessionParticipants'])->name('session-participants');
