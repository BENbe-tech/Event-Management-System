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
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Models\Event;
use App\Models\EventDetail;
use App\Models\Category;

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
Route::group(['middleware'=>'prevent-back-history'],function(){

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


Route::get('/login',[CustomAuthController::class,'login'])->middleware('alreadyLoggedIn');


Route::get('/registration',[CustomAuthController::class,'registration'])->middleware('alreadyLoggedIn');


Route::post('/register-user',[CustomAuthController::class,'registerUser'])->name('register-user');


Route::post('login-user',[CustomAuthController::class,'loginUser'])->name('login-user');


Route::get('login-user1',[CustomAuthController::class,'login'])->name('login-user1');


Route::get('/dashboard',[DashboardController::class,'dashboard'])->middleware('isLoggedIn');


Route::post('/logout',[CustomAuthController::class,'logout'])->name('logout')->middleware('isLoggedIn');


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget-password');


Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');


Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');


Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::get('/create-event',[CreateEventController::class,'index'])->name('create-event')->middleware('isLoggedIn');


Route::post('/create-event1',[CreateEventController::class,'createEvent'])->name('create-event1')->middleware('isLoggedIn');


Route::get('/organizer',[OrganizerController::class,'index'])->name('organizer')->middleware('isLoggedIn');


Route::post('/create-organizer',[OrganizerController::class,'createorganizer'])->name('create-organizer')->middleware('isLoggedIn');


Route::get('/myevents',[MyEventsController::class,'myevent'])->name('myevents')->middleware('isLoggedIn');


Route::get('/myeventdetails/{id}',[MyEventsController::class,'index'])->name('myeventdetails')->middleware('isLoggedIn');


Route::get('/download/{file}',[MyEventsController::class,'download'])->name('download')->middleware('isLoggedIn');


Route::get('/delete/{id}',[MyEventsController::class,'delete'])->name('delete')->middleware('isLoggedIn');


Route::get('/edit/{id}',[MyEventsController::class,'edit'])->name('edit')->middleware('isLoggedIn');


Route::post('/update',[MyEventsController::class,'update'])->name('update')->middleware('isLoggedIn');


Route::get('/home',[HomeController::class,'index'])->name('home')->middleware('isLoggedIn');


Route::post('/home-search',[HomeController::class,'search'])->name('home-search');


Route::get('/home-event/{id}',[HomeController::class,'homeevent'])->name('home-event');


Route::get('/event-sessions/{id}',[HomeController::class,'showsessions'])->name('event-sessions');


Route::get('/event-sessiondetails/{id}',[HomeController::class,'showsessiondetails'])->name('event-sessiondetails');



Route::get('/registered-events',[RegisteredEventsController::class,'index'])->name('registered-events')->middleware('isLoggedIn');


Route::get('/schedule',[RegisteredEventsController::class,'schedule'])->name('schedule')->middleware('isLoggedIn');


// Route::get('/verify/{id}',[RegisteredEventsController::class,'verify'])->name('verify')->middleware('isLoggedIn');


Route::post('/verifymode',[RegisteredEventsController::class,'verifyMode'])->name('verifymode')->middleware('isLoggedIn');



Route::get('/participants/{event_id}/{user_id}',[RegisteredEventsController::class,'participants'])->name('participants')->middleware('isLoggedIn');



Route::get('/eventdetails/{id}',[RegisteredEventsController::class,'eventdetails'])->name('eventdetails')->middleware('isLoggedIn');



Route::get('/registeredevents-sessions/{id}',[RegisteredEventsController::class,'showsessions'])->name('registeredevents-sessions')->middleware('isLoggedIn');



Route::get('/participant.sessions/{id}',[RegisteredEventsController::class,'registeredSessions'])->name('participant.sessions')->middleware('isLoggedIn');



Route::get('/registeredevents-sessiondetails/{id}',[RegisteredEventsController::class,'showsessiondetails'])->name('registeredevents-sessiondetails')->middleware('isLoggedIn');


Route::get('/session-participants/{event_id}/{user_id}/{session_id}',[RegisteredEventsController::class,'sessionParticipants'])->name('session-participants')->middleware('isLoggedIn');



Route::get('/create-session/{id}',[SessionController::class,'index'])->name('create-session')->middleware('isLoggedIn');


Route::post('/create-session1',[SessionController::class,'createSession'])->name('create-session1')->middleware('isLoggedIn');


Route::get('/delete.session/{id}',[SessionController::class,'delete'])->name('delete.session')->middleware('isLoggedIn');


Route::get('/edit.session/{id}/{event_id}',[SessionController::class,'edit'])->name('edit.session')->middleware('isLoggedIn');


Route::post('/update.session',[SessionController::class,'update'])->name('update.session')->middleware('isLoggedIn');



Route::get('/sessions/{id}',[SessionController::class,'showsessions'])->name('sessions')->middleware('isLoggedIn');


Route::get('/sessiondetails/{id}/{event_id}',[SessionController::class,'showsessiondetails'])->name('sessiondetails')->middleware('isLoggedIn');


Route::get('/downloaddoc/{file}',[SessionController::class,'download'])->name('downloaddoc')->middleware('isLoggedIn');


Route::get('/comment/{id}',[CommentsController::class,'participantComments'])->name('comment')->middleware('isLoggedIn');


Route::get('/fetchComment/{id}',[CommentsController::class,'Comments'])->name('fetchComment')->middleware('isLoggedIn');


Route::post('/post-comment',[CommentsController::class,'PostComments'])->name('post-comment')->middleware('isLoggedIn');


Route::get('/addtocalendar/{event_title}/{eventdetails_id}',[CalendarController::class,'Calendar'])->name('addtocalendar');


Route::get('/social-media-share', [SocialShareButtonsController::class,'ShareWidget'])->name('social-media-share');


Route::get('/send-email',[MailController::class,'sendEmail'])->middleware('isLoggedIn');


Route::get('/profile/{id}',[ProfileController::class,'profile'])->name('profile')->middleware('isLoggedIn');


Route::get('/update-profile/{id}',[ProfileController::class,'showUpdateProfile'])->name('update-profile')->middleware('isLoggedIn');


Route::post('/updates-profile',[ProfileController::class,'UpdateProfile'])->name('updates-profile')->middleware('isLoggedIn');


Route::get('/createdevents-report',[ReportController::class,'index'])->name('createdevents-report')->middleware('isLoggedIn');


Route::get('/event-report/{id}',[ReportController::class,'eventReport'])->name('event-report')->middleware('isLoggedIn');


Route::get('/eventsessions-report/{id}',[ReportController::class,'eventSessionsReport'])->name('eventsessions-report')->middleware('isLoggedIn');


Route::get('/session.report/{id}',[ReportController::class,'SessionReport'])->name('session.report')->middleware('isLoggedIn');


Route::get('/bar-graph.report',[ReportController::class,'BarGraph'])->name('bar-graph.report')->middleware('isLoggedIn');


Route::get('/line-graph.report',[ReportController::class,'LineGraph'])->name('line-graph.report')->middleware('isLoggedIn');


Route::get('file-import-export', [ReportController::class, 'fileImportExport']);


Route::post('file-import', [ReportController::class, 'fileImport'])->name('file-import')->middleware('isLoggedIn');



Route::get('file-export/{id}', [ReportController::class, 'fileExport'])->name('file-export')->middleware('isLoggedIn');


Route::get('download.eventreport.pdf/{id}',[ReportController::class, 'downloadEventPDF'])->name('download.eventreport.pdf')->middleware('isLoggedIn');



Route::get('/send.notification/{id}',[MyEventsController::class,'sendnotification'])->name('send.notification')->middleware('isLoggedIn');


Route::post('/save-token', [MyEventsController::class, 'saveToken'])->name('save-token')->middleware('isLoggedIn');



Route::post('/push-notification', [MyEventsController::class, 'pushNotification'])->name('push-notification')->middleware('isLoggedIn');


Route::post('/push-sessionnotification', [MyEventsController::class, 'pushSessionNotification'])->name('push-sessionnotification')->middleware('isLoggedIn');


Route::get('/notify/{id}', [MyEventsController::class, 'notifyIndex'])->name('notify')->middleware('isLoggedIn');


Route::get('/session-notify/{session_id}/{event_id}', [MyEventsController::class, 'notifySessionIndex'])->name('session-notify')->middleware('isLoggedIn');


Route::get('/ticket/{id}',[TicketController::class,'ticket'])->name('ticket')->middleware('isLoggedIn');


Route::get('/register.ticket',[TicketController::class,'index'])->name('register.ticket')->middleware('isLoggedIn');


Route::get('/qrscanner',[TicketController::class,'qrscanner'])->name('qrscanner')->middleware('isLoggedIn');



Route::post('/participantpay',[PaymentController::class,'ParticipantPay'])->name('participantpay')->middleware('isLoggedIn');


Route::get('/participant-payview/{id}',[PaymentController::class,'Participantindex'])->name('participant-payview')->middleware('isLoggedIn');

});
