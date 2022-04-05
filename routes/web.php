<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CreateEventController;
use App\Http\Controllers\MyEventsController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisteredEventsController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;


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


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget-password');

Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');

Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::get('/create-event',[CreateEventController::class,'index'])->name('create-event');

Route::post('/create-event1',[CreateEventController::class,'createEvent'])->name('create-event1');


Route::get('/organizer',[OrganizerController::class,'index'])->name('organizer');

Route::post('/create-organizer',[OrganizerController::class,'createorganizer'])->name('create-organizer');

Route::get('/myevents',[MyEventsController::class,'myevent'])->name('myevents');


Route::get('/myeventdetails/{id}',[MyEventsController::class,'index'])->name('myeventdetails');

Route::get('/download/{file}',[MyEventsController::class,'download'])->name('download');


Route::get('/delete/{id}',[MyEventsController::class,'delete'])->name('delete');


Route::get('/edit/{id}',[MyEventsController::class,'edit'])->name('edit');


Route::post('/update',[MyEventsController::class,'update'])->name('update');


Route::get('/home',[HomeController::class,'index'])->name('home')->middleware('isLoggedIn');


Route::post('/home-search',[HomeController::class,'search'])->name('home-search');

Route::get('/home-event/{id}',[HomeController::class,'homeevent'])->name('home-event');

Route::get('/event-sessions/{id}',[HomeController::class,'showsessions'])->name('event-sessions');

Route::get('/event-sessiondetails/{id}',[HomeController::class,'showsessiondetails'])->name('event-sessiondetails');



Route::get('/registered-events',[RegisteredEventsController::class,'index'])->name('registered-events');


Route::get('/schedule',[RegisteredEventsController::class,'schedule'])->name('schedule');


Route::get('/verify/{id}',[RegisteredEventsController::class,'verify'])->name('verify');



Route::get('/participants/{event_id}/{user_id}',[RegisteredEventsController::class,'participants'])->name('participants');

Route::get('/eventdetails/{id}',[RegisteredEventsController::class,'eventdetails'])->name('eventdetails');


Route::get('/registeredevents-sessions/{id}',[RegisteredEventsController::class,'showsessions'])->name('registeredevents-sessions');



Route::get('/participant.sessions/{id}',[RegisteredEventsController::class,'registeredSessions'])->name('participant.sessions');



Route::get('/registeredevents-sessiondetails/{id}',[RegisteredEventsController::class,'showsessiondetails'])->name('registeredevents-sessiondetails');


Route::get('/session-participants/{event_id}/{user_id}/{session_id}',[RegisteredEventsController::class,'sessionParticipants'])->name('session-participants');



Route::get('/create-session/{id}',[SessionController::class,'index'])->name('create-session');


Route::post('/create-session1',[SessionController::class,'createSession'])->name('create-session1');


Route::get('/delete.session/{id}',[SessionController::class,'delete'])->name('delete.session');


Route::get('/edit.session/{id}/{event_id}',[SessionController::class,'edit'])->name('edit.session');


Route::post('/update.session',[SessionController::class,'update'])->name('update.session');



Route::get('/sessions/{id}',[SessionController::class,'showsessions'])->name('sessions');

Route::get('/sessiondetails/{id}/{event_id}',[SessionController::class,'showsessiondetails'])->name('sessiondetails');

Route::get('/downloaddoc/{file}',[SessionController::class,'download'])->name('downloaddoc');

Route::get('/comment/{id}',[CommentsController::class,'participantComments'])->name('comment');


Route::post('/post-comment',[CommentsController::class,'PostComments'])->name('post-comment');


Route::get('/addtocalendar/{event_title}/{eventdetails_id}',[CalendarController::class,'Calendar'])->name('addtocalendar');


Route::get('/social-media-share', [SocialShareButtonsController::class,'ShareWidget'])->name('social-media-share');


Route::get('/send-email',[MailController::class,'sendEmail']);


Route::get('/profile/{id}',[ProfileController::class,'profile'])->name('profile');


Route::get('/update-profile/{id}',[ProfileController::class,'showUpdateProfile'])->name('update-profile');


Route::post('/updates-profile',[ProfileController::class,'UpdateProfile'])->name('updates-profile');


Route::get('/createdevents-report',[ReportController::class,'index'])->name('createdevents-report');


Route::get('/event-report/{id}',[ReportController::class,'eventReport'])->name('event-report');


Route::get('/eventsessions-report/{id}',[ReportController::class,'eventSessionsReport'])->name('eventsessions-report');


Route::get('/session.report/{id}',[ReportController::class,'SessionReport'])->name('session.report');
