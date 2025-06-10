<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UniversityEventApprovalController;
use App\Http\Controllers\FacultyLevelUnionController;

//Index Route
Route::get('/', [EventController::class, 'home'])->name('home');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/som', function () {
//     return view('som');
// })->name('som');

// Event Scheduling Routes
Route::get('/schedule-event', [EventController::class, 'schedule'])->name('sheduler');
Route::post('/schedule-event',[EventController::class,'store'])->name('schedule-event');

// Auth Routes
Route::get('/login',[AuthController::class,'loginpage'])->name('loginpage');
Route::post('/login',[AuthController::class,'login'])->name('loginsubmit');

Route::get('/sign',[AuthController::class,'signpage'])->name('signpage');
Route::post('/sign',[AuthController::class,'sign'])->name('signsubmit');

// Route::get('/admin',[AuthController::class,'admin'])->name('admin');

// Route::get('/scheduled-events', function () {
//     return view('scheduled_events');
// })->name('scheduled.events');

Route::get('/scheduled-events', [EventController::class, 'scheduledEvents'])->name('scheduled-events');

//scheduled events
Route::get('/schedule', [EventController::class, 'showSchedule'])->name('schedule');

// University Level Approval Starts Here 


// Route::get('/ar', function () {
//     return view('university_Level.ar');
// })->name('ar.page')->middleware('auth');

// Route::get('/marshall', function () {
//     return view('university_Level.marshall');
// })->name('marshall.page')->middleware('auth');

// Route::get('/proctor', function () {
//     return view('university_Level.proctor');
// })->name('proctor.page')->middleware('auth');

// Route::get('/vice_chancellor', function () {
//     return view('university_Level.vice_chancellor');
// })->name('vice_chancellor.page')->middleware('auth');



// Assistant Registrar 
Route::get('/ar-pending-requests', [UniversityEventApprovalController::class, 'showPendingARRequests'])->name('ar.pending.requests')->middleware('auth');;
Route::patch('/ar/accept/{id}', [UniversityEventApprovalController::class, 'ArAccept'])->name('ar.accept');
Route::patch('/ar/reject/{id}', [UniversityEventApprovalController::class, 'ArReject'])->name('ar.reject');

// Marshall 
Route::get('/marshall-pending-requests', [UniversityEventApprovalController::class, 'showPendingMarshallRequests'])->name('marshall.pending.requests')->middleware('auth');;
Route::patch('/marshall/accept/{id}', [UniversityEventApprovalController::class, 'MarshallAccept'])->name('marshall.accept');
Route::patch('/marshall/reject/{id}', [UniversityEventApprovalController::class, 'MarshallReject'])->name('marshall.reject');

// Proctor 
Route::get('/proctor-pending-requests', [UniversityEventApprovalController::class, 'showPendingProctorRequests'])->name('proctor.pending.requests')->middleware('auth');;
Route::patch('/proctor/accept/{id}', [UniversityEventApprovalController::class, 'ProctorAccept'])->name('proctor.accept');
Route::patch('/proctor/reject/{id}', [UniversityEventApprovalController::class, 'ProctorReject'])->name('proctor.reject');

// Vice Chancellor
Route::get('/vice-chancellor-pending-requests', [UniversityEventApprovalController::class, 'showPendingVcRequests'])->name('vice_chancellor.pending.requests')->middleware('auth');;
Route::patch('/vice-chancellor/accept/{id}', [UniversityEventApprovalController::class, 'VcAccept'])->name('vice_chancellor.accept');
Route::patch('/vice-chancellor/reject/{id}', [UniversityEventApprovalController::class, 'VcReject'])->name('vice_chancellor.reject');

//Administrator Routes
Route::get('/admin', [AuthController::class, 'pendingEvents'])->name('admin');

Route::patch('/admin/accept/{id}', [AuthController::class, 'accept'])->name('admin.accept');
Route::patch('/admin/reject/{id}', [AuthController::class, 'reject'])->name('admin.reject');

Route::delete('/faculties/{id}', [AuthController::class, 'FacultyDestroy'])->name('faculties.destroy');
Route::post('/faculties', [AuthController::class, 'FacultyStore'])->name('faculties.store');

Route::delete('/venues/{id}', [AuthController::class, 'VenueDestroy'])->name('venues.destroy');
Route::post('/venues', [AuthController::class, 'VenueStore'])->name('venues.store');








// Route::get('/schedule/university', function () {
//     return view('Schedulers.schedule_event'); // Make sure this view exists
// })->name('schedule.university');

// Route::get('/schedule/Union', function () {
//     return view('Schedulers.FacultyLevelUnion'); // Make sure this view exists
// })->name('schedule.union');

Route::get('/schedule/society', function () {
    return view('Schedulers.FacultyLevelSocieties'); // Make sure this view exists
})->name('schedule.society');

Route::get('/schedule/Batch', function () {
    return view('Schedulers.FacultyLevelBatch'); // Make sure this view exists
})->name('schedule.batch');

Route::get('/schedule/university', [UniversityEventApprovalController::class, 'showUnionForm'])->name('schedule.university');
Route::get('/get-halls/{facultyCode}', [UniversityEventApprovalController::class, 'getHalls'])->name('get.halls');
Route::post('/scheduleUniversityEvent',[UniversityEventApprovalController::class,'store'])->name('scheduleUniEvent');

Route::get('/schedule/union', [FacultyLevelUnionController::class, 'showUnionForm'])->name('schedule.union');
Route::get('/get-halls/{facultyCode}', [FacultyLevelUnionController::class, 'getHalls'])->name('get.halls');
Route::post('/scheduleUnionEvent',[FacultyLevelUnionController::class,'store'])->name('scheduleUnionEvent');

