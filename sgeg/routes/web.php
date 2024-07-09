<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDIController;
use App\Http\Controllers\GarmentController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\AttachController;
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

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/search', [UserController::class, 'search'])->name('search-get');
Route::post('/search', [UserController::class, 'searchPost'])->name('search');



Route::resource('/garment', GarmentController::class)->names('garment');
Route::resource('/pdi', PDIController::class)->names('pdi');
Route::resource('/degree', DegreeController::class)->names('degree');

//Send email
Route::get('/email', [MailController::class, 'index'])->name('index');
Route::get('/sendmail', [MailController::class, 'sendMail'])->name('sendmail');

//CSV import
Route::get('/userimport', [CsvController::class, 'index'])->name('userImport');
Route::post('/import', [CsvController::class, 'import'])->name('import');
Route::get('/export', [CsvController::class, 'export'])->name('export');

//PDF
Route::get('/pdf', [AttachController::class, 'invite'])->name('invite');
