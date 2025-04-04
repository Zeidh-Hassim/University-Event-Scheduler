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