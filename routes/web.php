<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/schedule-event', [EventController::class, 'index'])->name('sheduler');
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

