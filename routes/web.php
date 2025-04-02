<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/schedule-event', [EventController::class, 'index'])->name('sheduler');
Route::post('/schedule-event',[EventController::class,'store'])->name('schedule-event');
//Route::post('/schedule-event', [EventController::class, 'store']);