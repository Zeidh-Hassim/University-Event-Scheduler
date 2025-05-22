<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/som', function () {
    return view('som');
})->name('som');


Route::get('/schedule-event', [EventController::class, 'schedule'])->name('sheduler');
Route::post('/schedule-event',[EventController::class,'store'])->name('schedule-event');

Route::get('/login',[AuthController::class,'loginpage'])->name('loginpage');
Route::post('/login',[AuthController::class,'login'])->name('loginsubmit');

Route::get('/sign',[AuthController::class,'signpage'])->name('signpage');
Route::post('/sign',[AuthController::class,'sign'])->name('signsubmit');

Route::get('/admin',[AuthController::class,'admin'])->name('admin');

// Route::get('/scheduled-events', function () {
//     return view('scheduled_events');
// })->name('scheduled.events');

Route::get('/scheduled-events', [EventController::class, 'scheduledEvents'])->name('scheduled-events');


Route::get('/admin', [AuthController::class, 'pendingEvents'])->name('admin');

Route::patch('/admin/accept/{id}', [AuthController::class, 'accept'])->name('admin.accept');
Route::patch('/admin/reject/{id}', [AuthController::class, 'reject'])->name('admin.reject');

Route::get('/schedule', [EventController::class, 'showSchedule'])->name('schedule');

Route::get('/', [EventController::class, 'home'])->name('home');



Route::get('/ar', function () {
    return view('university_Level.ar');
})->name('ar.page')->middleware('auth');

Route::get('/marshall', function () {
    return view('university_Level.marshall');
})->name('marshall.page')->middleware('auth');

Route::get('/proctor', function () {
    return view('university_Level.proctor');
})->name('proctor.page')->middleware('auth');

Route::get('/vice_chancellor', function () {
    return view('university_Level.vice_chancellor');
})->name('vice_chancellor.page')->middleware('auth');