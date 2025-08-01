<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UniversityEventApprovalController;
use App\Http\Controllers\FacultyLevelUnionController;

//Index Route
Route::get('/', [EventController::class, 'home'])->name('home');

// Auth Routes
Route::get('/login',[AuthController::class,'loginpage'])->name('loginpage');
Route::post('/login',[AuthController::class,'login'])->name('loginsubmit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logoutsubmit');



Route::get('/sign',[AuthController::class,'signpage'])->name('signpage');
Route::post('/sign',[AuthController::class,'sign'])->name('signsubmit');

//schedule events
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

Route::patch('/fas-ar-union/accept/{id}', [UniversityEventApprovalController::class, 'FASArUnionAccept'])->name('fasarUnion.accept');
Route::patch('/fas-ar-union/reject/{id}', [UniversityEventApprovalController::class, 'FASArUnionReject'])->name('fasarUnion.reject');
Route::patch('/fas-ar-society/accept/{id}', [UniversityEventApprovalController::class, 'FASArSocietyAccept'])->name('fasarSociety.accept');
Route::patch('/fas-ar-society/reject/{id}', [UniversityEventApprovalController::class, 'FASArSocietyReject'])->name('fasarSociety.reject');
Route::patch('/fas-ar-batch/accept/{id}', [UniversityEventApprovalController::class, 'FASArBatchAccept'])->name('fasarBatch.accept');
Route::patch('/fas-ar-batch/reject/{id}', [UniversityEventApprovalController::class, 'FASArBatchReject'])->name('fasarBatch.reject');



// FBS Assistant Registrar
Route::get('/fbs-ar-pending-requests', [UniversityEventApprovalController::class, 'showPendingFBSARRequests'])->name('fbsar.pending.requests')->middleware('auth');
Route::patch('/fbs-ar/accept/{id}', [UniversityEventApprovalController::class, 'FBSArAccept'])->name('fbsar.accept');
Route::patch('/fbs-ar/reject/{id}', [UniversityEventApprovalController::class, 'FBSArReject'])->name('fbsar.reject');
Route::patch('/fbs-ar-union/accept/{id}', [UniversityEventApprovalController::class, 'FBSArUnionAccept'])->name('fbsarUnion.accept');
Route::patch('/fbs-ar-union/reject/{id}', [UniversityEventApprovalController::class, 'FBSArUnionReject'])->name('fbsarUnion.reject');
Route::patch('/fbs-ar-society/accept/{id}', [UniversityEventApprovalController::class, 'FBSArSocietyAccept'])->name('fbsarSociety.accept');
Route::patch('/fbs-ar-society/reject/{id}', [UniversityEventApprovalController::class, 'FBSArSocietyReject'])->name('fbsarSociety.reject');
Route::patch('/fbs-ar-batch/accept/{id}', [UniversityEventApprovalController::class, 'FBSArBatchAccept'])->name('fbsarBatch.accept');
Route::patch('/fbs-ar-batch/reject/{id}', [UniversityEventApprovalController::class, 'FBSArBatchReject'])->name('fbsarBatch.reject');


// FTS Assistant Registrar
Route::get('/fts-ar-pending-requests', [UniversityEventApprovalController::class, 'showPendingFTSARRequests'])->name('ftsar.pending.requests')->middleware('auth');
Route::patch('/fts-ar/accept/{id}', [UniversityEventApprovalController::class, 'FTSArAccept'])->name('ftsar.accept');
Route::patch('/fts-ar/reject/{id}', [UniversityEventApprovalController::class, 'FTSArReject'])->name('ftsar.reject');

Route::patch('/fts-ar-union/accept/{id}', [UniversityEventApprovalController::class, 'FTSArUnionAccept'])->name('ftsarUnion.accept');
Route::patch('/fts-ar-union/reject/{id}', [UniversityEventApprovalController::class, 'FTSArUnionReject'])->name('ftsarUnion.reject');
Route::patch('/fts-ar-society/accept/{id}', [UniversityEventApprovalController::class, 'FTSArSocietyAccept'])->name('ftsarSociety.accept');
Route::patch('/fts-ar-society/reject/{id}', [UniversityEventApprovalController::class, 'FTSArSocietyReject'])->name('ftsarSociety.reject');
Route::patch('/fts-ar-batch/accept/{id}', [UniversityEventApprovalController::class, 'FTSArBatchAccept'])->name('ftsarBatch.accept');
Route::patch('/fts-ar-batch/reject/{id}', [UniversityEventApprovalController::class, 'FTSArBatchReject'])->name('ftsarBatch.reject');

// Marshall 
Route::get('/marshall-pending-requests', [UniversityEventApprovalController::class, 'showPendingMarshallRequests'])->name('marshall.pending.requests')->middleware('auth');
Route::patch('/marshall/accept/{id}', [UniversityEventApprovalController::class, 'MarshallAccept'])->name('marshall.accept');
Route::patch('/marshall/reject/{id}', [UniversityEventApprovalController::class, 'MarshallReject'])->name('marshall.reject');

Route::patch('/marshall-union/accept/{id}', [UniversityEventApprovalController::class, 'MarshallUnionAccept'])->name('marshallUnion.accept');
Route::patch('/marshall-union/reject/{id}', [UniversityEventApprovalController::class, 'MarshallUnionReject'])->name('marshallUnion.reject');
Route::patch('/marshall-batch/accept/{id}', [UniversityEventApprovalController::class, 'MarshallBatchAccept'])->name('marshallBatch.accept');
Route::patch('/marshall-batch/reject/{id}', [UniversityEventApprovalController::class, 'MarshallBatchReject'])->name('marshallBatch.reject');


// Proctor 
Route::get('/proctor-pending-requests', [UniversityEventApprovalController::class, 'showPendingProctorRequests'])->name('proctor.pending.requests')->middleware('auth');
Route::patch('/proctor/accept/{id}', [UniversityEventApprovalController::class, 'ProctorAccept'])->name('proctor.accept');
Route::patch('/proctor/reject/{id}', [UniversityEventApprovalController::class, 'ProctorReject'])->name('proctor.reject');

// Vice Chancellor
Route::get('/vice-chancellor-pending-requests', [UniversityEventApprovalController::class, 'showPendingVcRequests'])->name('vice_chancellor.pending.requests')->middleware('auth');;
Route::patch('/vice-chancellor/accept/{id}', [UniversityEventApprovalController::class, 'VcAccept'])->name('vice_chancellor.accept');
Route::patch('/vice-chancellor/reject/{id}', [UniversityEventApprovalController::class, 'VcReject'])->name('vice_chancellor.reject');




// FAS Deputy proctor
// Route::get('/fas-dp-pending-requests', [UniversityEventApprovalController::class, 'showPendingFASDPRequests'])->name('fasdp.pending.requests')->middleware('auth');
// Route::patch('/fas-ar/accept/{id}', [UniversityEventApprovalController::class, 'FASArAccept'])->name('fasar.accept');
// Route::patch('/fas-ar/reject/{id}', [UniversityEventApprovalController::class, 'FASArReject'])->name('fasar.reject');

// Route::get('/fas-dp-union-pending-requests', [FacultyLevelUnionController::class, 'showPendingFASDPUnionRequests'])->name('fasdp.union.pending.requests')->middleware('auth');
Route::get('/fas-dp-pending-requests', [UniversityEventApprovalController::class, 'showPendingFASDPRequests'])->name('fasdp.pending.requests')->middleware('auth');
Route::patch('/fas-dp-union/accept/{id}', [UniversityEventApprovalController::class, 'FASDPUnionAccept'])->name('fasdpUnion.accept');
Route::patch('/fas-dp-union/reject/{id}', [UniversityEventApprovalController::class, 'FASDPUnionReject'])->name('fasdpUnion.reject');

Route::patch('/fas-dp-batch/accept/{id}', [UniversityEventApprovalController::class, 'FASDPBatchAccept'])->name('fasdpBatch.accept');
Route::patch('/fas-dp-batch/reject/{id}', [UniversityEventApprovalController::class, 'FASDPBatchReject'])->name('fasdpBatch.reject');



//FBS Deputy proctor
Route::get('/fbs-dp-pending-requests', [UniversityEventApprovalController::class, 'showPendingFBSDPRequests'])->name('fbsdp.pending.requests')->middleware('auth');
Route::patch('/fbs-dp-union/accept/{id}', [UniversityEventApprovalController::class, 'FBSDPUnionAccept'])->name('fbsdpUnion.accept');
Route::patch('/fbs-dp-union/reject/{id}', [UniversityEventApprovalController::class, 'FBSDPUnionReject'])->name('fbsdpUnion.reject');

Route::patch('/fbs-dp-batch/accept/{id}', [UniversityEventApprovalController::class, 'FBSDPBatchAccept'])->name('fbsdpBatch.accept');
Route::patch('/fbs-dp-batch/reject/{id}', [UniversityEventApprovalController::class, 'FBSDPBatchReject'])->name('fbsdpBatch.reject');

//FTS Deputy proctor
Route::get('/fts-dp-pending-requests', [UniversityEventApprovalController::class, 'showPendingFTSDPRequests'])->name('ftsdp.pending.requests')->middleware('auth');
Route::patch('/fts-dp-union/accept/{id}', [UniversityEventApprovalController::class, 'FTSDPUnionAccept'])->name('ftsdpUnion.accept');
Route::patch('/fts-dp-union/reject/{id}', [UniversityEventApprovalController::class, 'FTSDPUnionReject'])->name('ftsdpUnion.reject');

Route::patch('/fts-dp-batch/accept/{id}', [UniversityEventApprovalController::class, 'FTSDPBatchAccept'])->name('ftsdpBatch.accept');
Route::patch('/fts-dp-batch/reject/{id}', [UniversityEventApprovalController::class, 'FTSDPBatchReject'])->name('ftsdpBatch.reject');

// FAS Dean
Route::get('/fas-dean-pending-requests', [UniversityEventApprovalController::class, 'showPendingFASDeanRequests'])->name('fasdean.pending.requests')->middleware('auth');
Route::patch('/fas-dean-union/accept/{id}', [UniversityEventApprovalController::class, 'FASDeanUnionAccept'])->name('fasdeanUnion.accept');
Route::patch('/fas-dean-union/reject/{id}', [UniversityEventApprovalController::class, 'FASDeanUnionReject'])->name('fasdeanUnion.reject');

Route::patch('/fas-dean-batch/accept/{id}', [UniversityEventApprovalController::class, 'FASDeanBatchAccept'])->name('fasdeanBatch.accept');
Route::patch('/fas-dean-batch/reject/{id}', [UniversityEventApprovalController::class, 'FASDeanBatchReject'])->name('fasdeanBatch.reject');

Route::patch('/fas-dean-Society/accept/{id}', [UniversityEventApprovalController::class, 'FASDeanSocietyAccept'])->name('fasdeanSociety.accept');
Route::patch('/fas-dean-Society/reject/{id}', [UniversityEventApprovalController::class, 'FASDeanSocietyReject'])->name('fasdeanSociety.reject');

// FBS Dean
Route::get('/fbs-dean-pending-requests', [UniversityEventApprovalController::class, 'showPendingFASDeanRequests'])->name('fasdean.pending.requests')->middleware('auth');
Route::patch('/fbs-dean-union/accept/{id}', [UniversityEventApprovalController::class, 'FBSDeanUnionAccept'])->name('fbsdeanUnion.accept');
Route::patch('/fbs-dean-union/reject/{id}', [UniversityEventApprovalController::class, 'FBSDeanUnionReject'])->name('fbsdeanUnion.reject');

Route::patch('/fbs-dean-batch/accept/{id}', [UniversityEventApprovalController::class, 'FBSDeanBatchAccept'])->name('fbsdeanBatch.accept');
Route::patch('/fbs-dean-batch/reject/{id}', [UniversityEventApprovalController::class, 'FBSDeanBatchReject'])->name('fbsdeanBatch.reject');

Route::patch('/fbs-dean-Society/accept/{id}', [UniversityEventApprovalController::class, 'FBSDeanSocietyAccept'])->name('fbsdeanSociety.accept');
Route::patch('/fbs-dean-Society/reject/{id}', [UniversityEventApprovalController::class, 'FBSDeanSocietyReject'])->name('fbsdeanSociety.reject');

// FTS Dean
Route::get('/fts-dean-pending-requests', [UniversityEventApprovalController::class, 'showPendingFASDeanRequests'])->name('fasdean.pending.requests')->middleware('auth');
Route::patch('/fts-dean-union/accept/{id}', [UniversityEventApprovalController::class, 'FTSDeanUnionAccept'])->name('ftsdeanUnion.accept');
Route::patch('/fts-dean-union/reject/{id}', [UniversityEventApprovalController::class, 'FTSDeanUnionReject'])->name('ftsdeanUnion.reject');

Route::patch('/fts-dean-batch/accept/{id}', [UniversityEventApprovalController::class, 'FTSDeanBatchAccept'])->name('ftsdeanBatch.accept');
Route::patch('/fts-dean-batch/reject/{id}', [UniversityEventApprovalController::class, 'FTSDeanBatchReject'])->name('ftsdeanBatch.reject');

Route::patch('/fts-dean-Society/accept/{id}', [UniversityEventApprovalController::class, 'FTSDeanSocietyAccept'])->name('ftsdeanSociety.accept');
Route::patch('/fts-dean-Society/reject/{id}', [UniversityEventApprovalController::class, 'FTSDeanSocietyReject'])->name('ftsdeanSociety.reject');


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


//FAS HOD
Route::get('/fas-hod-pending-requests', [UniversityEventApprovalController::class, 'showPendingFASHODRequests'])->name('fashod.pending.requests')->middleware('auth');
Route::patch('/fas-hod-society/accept/{id}', [UniversityEventApprovalController::class, 'FASHODSocietyAccept'])->name('fashodSociety.accept');
Route::patch('/fas-hod-society/reject/{id}', [UniversityEventApprovalController::class, 'FASHODSocietyReject'])->name('fashodSociety.reject');

//FBS HOD
Route::get('/fbs-hod-pending-requests', [UniversityEventApprovalController::class, 'showPendingFBSHODRequests'])->name('fbshod.pending.requests')->middleware('auth');
Route::patch('/fbs-hod-society/accept/{id}', [UniversityEventApprovalController::class, 'FBSHODSocietyAccept'])->name('fbshodSociety.accept');
Route::patch('/fbs-hod-society/reject/{id}', [UniversityEventApprovalController::class, 'FBSHODSocietyReject'])->name('fbshodSociety.reject');

//FTS HOD
Route::get('/fts-hod-pending-requests', [UniversityEventApprovalController::class, 'showPendingFTSHODRequests'])->name('ftshod.pending.requests')->middleware('auth');
Route::patch('/fts-hod-society/accept/{id}', [UniversityEventApprovalController::class, 'FTSHODSocietyAccept'])->name('ftshodSociety.accept');
Route::patch('/fts-hod-society/reject/{id}', [UniversityEventApprovalController::class, 'FTSHODSocietyReject'])->name('ftshodSociety.reject');







// Route::get('/schedule/university', function () {
//     return view('Schedulers.schedule_event'); // Make sure this view exists
// })->name('schedule.university');

// Route::get('/schedule/Union', function () {
//     return view('Schedulers.FacultyLevelUnion'); // Make sure this view exists
// })->name('schedule.union');

// Route::get('/schedule/society', function () {
//     return view('Schedulers.FacultyLevelSocieties'); // Make sure this view exists
// })->name('schedule.society');

// Route::get('/schedule/Batch', function () {
//     return view('Schedulers.FacultyLevelBatch'); // Make sure this view exists
// })->name('schedule.batch');

Route::get('/schedule/university', [UniversityEventApprovalController::class, 'showUnionForm'])->name('schedule.university');
Route::get('/get-halls/{facultyCode}', [UniversityEventApprovalController::class, 'getHalls'])->name('get.halls');
Route::post('/scheduleUniversityEvent',[UniversityEventApprovalController::class,'store'])->name('scheduleUniEvent');
Route::get('/get-available-halls/{faculty}/{date}/{start}/{end}', [UniversityEventApprovalController::class, 'getAvailableHalls']);


Route::get('/schedule/union', [UniversityEventApprovalController::class, 'showUnionFormUnion'])->name('schedule.union');
// Route::get('/get-halls/{facultyCode}', [UniversityEventApprovalController::class, 'getHalls'])->name('get.halls');
Route::post('/scheduleUnionEvent',[UniversityEventApprovalController::class,'storeUnion'])->name('scheduleUniionEvent');
// Route::get('/get-available-halls/{faculty}/{date}/{start}/{end}', [UniversityEventApprovalController::class, 'g/etAvailableHalls']);

Route::get('/schedule/society', [UniversityEventApprovalController::class, 'showUnionFormSociety'])->name('schedule.society');
Route::post('/scheduleSocietyEvent',[UniversityEventApprovalController::class,'storeSociety'])->name('scheduleSocietyEvent');

Route::get('/schedule/batch', [UniversityEventApprovalController::class, 'showUnionFormBatch'])->name('schedule.batch');
Route::post('/scheduleBatchEvent',[UniversityEventApprovalController::class,'storeBatch'])->name('scheduleBatchEvent');

// Route::get('/schedule/union', [FacultyLevelUnionController::class, 'showUnionForm'])->name('schedule.union');
// Route::get('/get-halls/{facultyCode}', [FacultyLevelUnionController::class, 'getHalls'])->name('get.halls');
// Route::post('/scheduleUnionEvent',[FacultyLevelUnionController::class,'store'])->name('scheduleUnionEvent');














// Route::get('/fas-assistant-registrar', function () {
//     return view('Users.fas_ar');
// })->name('fasar.pending.requests')->middleware('auth');

// Route::get('/fbs-assistant-registrar', function () {
//     return view('Users.fbs_ar');
// })->name('fbsar.pending.requests')->middleware('auth');

// Route::get('/fts-assistant-registrar', function () {
//     return view('Users.fts_ar');
// })->name('ftsar.pending.requests')->middleware('auth');

// Route::get('/fas-deputy-proctor', function () {
//     return view('Users.fas_dp');
// })->name('fasdp.pending.requests')->middleware('auth');

// Route::get('/fbs-deputy-proctor', function () {
//     return view('Users.fbs_dp');
// })->name('fbsdp.pending.requests')->middleware('auth');

// Route::get('/fts-deputy-proctor', function () {
//     return view('Users.fts_dp');
// })->name('ftsdp.pending.requests')->middleware('auth');





// Route::get('/fas-hod', function () {
//     return view('Users.fas_hod');
// })->name('fashod.pending.requests')->middleware('auth');

// Route::get('/fbs-hod', function () {
//     return view('Users.fbs_hod');
// })->name('fbshod.pending.requests')->middleware('auth');

// Route::get('/fts-hod', function () {
//     return view('Users.fts_hod');
// })->name('ftshod.pending.requests')->middleware('auth');


// Route::get('/fas-dean', function () {
//     return view('Users.fas_dean');
// })->name('fasdean.pending.requests')->middleware('auth');

// Route::get('/fbs-dean', function () {
//     return view('Users.fbs_dean');
// })->name('fbsdean.pending.requests')->middleware('auth');

// Route::get('/fts-dean', function () {
//     return view('Users.fts_dean');
// })->name('ftsddean.pending.requests')->middleware('auth');


Route::get('send-mail', [MailController::class, 'index']);
