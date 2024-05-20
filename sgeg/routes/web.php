<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\GarmentController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CsvController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'index')->name('index');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('/garment', GarmentController::class)->names('garment');
Route::resource('/participant', ParticipantController::class);

//Send email
Route::get('/email', [MailController::class, 'index'])->name('index');
Route::get('/sendmail', [MailController::class, 'sendMail'])->name('sendmail');
//CSV import
Route::get('/userimport', [CsvController::class, 'index'])->name('userImport');
Route::post('/import', [CsvController::class, 'import'])->name('import');
Route::get('/export', [CsvController::class, 'export'])->name('export');
