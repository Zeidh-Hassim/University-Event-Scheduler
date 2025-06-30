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
// Route::get('/schedule-event', [EventController::class, 'schedule'])->name('sheduler');
// Route::post('/schedule-event',[EventController::class,'store'])->name('schedule-event');

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
Route::get('/ar-pending-requests', [UniversityEventApprovalController::class, 'showPendingARRequests'])->name('ar.pending.requests')->middleware('auth');
Route::patch('/ar/accept/{id}', [UniversityEventApprovalController::class, 'ArAccept'])->name('ar.accept');
Route::patch('/ar/reject/{id}', [UniversityEventApprovalController::class, 'ArReject'])->name('ar.reject');

// FAS Assistant Registrar
Route::get('/fas-ar-pending-requests', [UniversityEventApprovalController::class, 'showPendingFASARRequests'])->name('fasar.pending.requests')->middleware('auth');
Route::patch('/fas-ar/accept/{id}', [UniversityEventApprovalController::class, 'FASArAccept'])->name('fasar.accept');
Route::patch('/fas-ar/reject/{id}', [UniversityEventApprovalController::class, 'FASArReject'])->name('fasar.reject');
Route::get('/fas-ar-union-pending-requests', [FacultyLevelUnionController::class, 'showPendingFASARUnionRequests'])->name('fasar.union.pending.requests')->middleware('auth');


// FBS Assistant Registrar
Route::get('/fbs-ar-pending-requests', [UniversityEventApprovalController::class, 'showPendingFBSARRequests'])->name('fbsar.pending.requests')->middleware('auth');
Route::patch('/fbs-ar/accept/{id}', [UniversityEventApprovalController::class, 'FBSArAccept'])->name('fbsar.accept');
Route::patch('/fbs-ar/reject/{id}', [UniversityEventApprovalController::class, 'FBSArReject'])->name('fbsar.reject');

// FTS Assistant Registrar
Route::get('/fts-ar-pending-requests', [UniversityEventApprovalController::class, 'showPendingFTSARRequests'])->name('ftsar.pending.requests')->middleware('auth');
Route::patch('/fts-ar/accept/{id}', [UniversityEventApprovalController::class, 'FTSArAccept'])->name('ftsar.accept');
Route::patch('/fts-ar/reject/{id}', [UniversityEventApprovalController::class, 'FTSArReject'])->name('ftsar.reject');

// Marshall 
Route::get('/marshall-pending-requests', [UniversityEventApprovalController::class, 'showPendingMarshallRequests'])->name('marshall.pending.requests')->middleware('auth');
Route::patch('/marshall/accept/{id}', [UniversityEventApprovalController::class, 'MarshallAccept'])->name('marshall.accept');
Route::patch('/marshall/reject/{id}', [UniversityEventApprovalController::class, 'MarshallReject'])->name('marshall.reject');

// Proctor 
Route::get('/proctor-pending-requests', [UniversityEventApprovalController::class, 'showPendingProctorRequests'])->name('proctor.pending.requests')->middleware('auth');
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

Route::delete('/users/{id}', [AuthController::class, 'UserDestroy'])->name('user.destroy');
Route::post('/users', [AuthController::class, 'UserStore'])->name('user.store');








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
Route::get('/get-available-halls/{faculty}/{date}/{start}/{end}', [UniversityEventApprovalController::class, 'getAvailableHalls']);



Route::get('/schedule/union', [FacultyLevelUnionController::class, 'showUnionForm'])->name('schedule.union');
Route::get('/get-halls/{facultyCode}', [FacultyLevelUnionController::class, 'getHalls'])->name('get.halls');
Route::post('/scheduleUnionEvent',[FacultyLevelUnionController::class,'store'])->name('scheduleUnionEvent');














// Route::get('/fas-assistant-registrar', function () {
//     return view('Users.fas_ar');
// })->name('fasar.pending.requests')->middleware('auth');

// Route::get('/fbs-assistant-registrar', function () {
//     return view('Users.fbs_ar');
// })->name('fbsar.pending.requests')->middleware('auth');

// Route::get('/fts-assistant-registrar', function () {
//     return view('Users.fts_ar');
// })->name('ftsar.pending.requests')->middleware('auth');

Route::get('/fas-deputy-proctor', function () {
    return view('Users.fas_dp');
})->name('fasdp.pending.requests')->middleware('auth');

Route::get('/fbs-deputy-proctor', function () {
    return view('Users.fbs_dp');
})->name('fbsdp.pending.requests')->middleware('auth');

Route::get('/fts-deputy-proctor', function () {
    return view('Users.fts_dp');
})->name('ftsdp.pending.requests')->middleware('auth');





Route::get('/fas-hod', function () {
    return view('Users.fas_hod');
})->name('fashod.pending.requests')->middleware('auth');

Route::get('/fbs-hod', function () {
    return view('Users.fbs_hod');
})->name('fbshod.pending.requests')->middleware('auth');

Route::get('/fts-hod', function () {
    return view('Users.fts_hod');
})->name('ftshod.pending.requests')->middleware('auth');