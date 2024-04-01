<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\GarmentController;


Route::view('/', 'index')->name('index');
 
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/participant', [ParticipantController::class, 'index'])->name('participant');
Route::get('/garment', [GarmentController::class, 'index'])->name('garment');

//Route::resource('garment', GarmentController::class);