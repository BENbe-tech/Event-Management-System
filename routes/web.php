<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CreateEventController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MyEventsController;
use App\Http\Controllers\MyEventDetailsController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\StorageFileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeEventController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login',[CustomAuthController::class,'login'])->middleware('alreadyLoggedIn');

Route::get('/registration',[CustomAuthController::class,'registration'])->middleware('alreadyLoggedIn');


Route::post('/register-user',[CustomAuthController::class,'registerUser'])->name('register-user');

Route::post('login-user',[CustomAuthController::class,'loginUser'])->name('login-user');

Route::get('login-user1',[CustomAuthController::class,'login'])->name('login-user1');

Route::get('/dashboard',[DashboardController::class,'dashboard'])->middleware('isLoggedIn');

Route::post('/logout',[CustomAuthController::class,'logout'])->name('logout');

Route::get('/forgotpassword',[CustomAuthController::class,'forgotpassword'])->name('forgotpassword');

Route::get('/create-event',[CreateEventController::class,'index'])->name('create-event');

Route::post('/create-event1',[CreateEventController::class,'createEvent'])->name('create-event1');


Route::get('/category',[CategoryController::class,'index'])->name('category');

Route::get('/organizer',[OrganizerController::class,'index'])->name('organizer');

Route::post('/create-organizer',[OrganizerController::class,'createorganizer'])->name('create-organizer');

Route::get('/myevents',[MyEventsController::class,'index'])->name('myevents');

Route::get('/myeventdetails/{id}',[MyEventDetailsController::class,'index'])->name('myeventdetails');

Route::get('/download/{file}',[MyEventDetailsController::class,'download'])->name('download');

Route::get('/forgotpassword',[ForgotPasswordController::class,'index'])->name('forgotpassword');

Route::get('/home',[HomeController::class,'index'])->name('home')->middleware('isLoggedIn');


Route::post('/home-search',[HomeController::class,'search'])->name('home-search');

Route::get('/home-event/{id}',[HomeEventController::class,'index'])->name('home-event');
