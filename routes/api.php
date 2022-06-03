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
