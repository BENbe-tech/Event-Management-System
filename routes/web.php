<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CreateEventController;
use App\Http\Controllers\OrganizerController;

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

Route::get('/create-event',[CreateEventController::class,'createEvent'])->name('create-event');

Route::get('/category',[CategoryController::class,'index'])->name('category');

Route::get('/organizer',[OrganizerController::class,'index'])->name('organizer');

Route::post('/create-organizer',[OrganizerController::class,'createorganizer'])->name('create-organizer');
