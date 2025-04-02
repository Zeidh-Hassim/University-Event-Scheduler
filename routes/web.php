<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/schedule-event', [EventController::class, 'index'])->name('sheduler');
Route::post('/schedule-event',[EventController::class,'store'])->name('schedule-event');
//Route::post('/schedule-event', [EventController::class, 'store']);

Route::get('/login',[AuthController::class,'loginpage'])->name('loginpage');
Route::post('/login',[AuthController::class,'login'])->name('loginsubmit');

Route::get('/admin',function (){ 
    return view('admin');
});