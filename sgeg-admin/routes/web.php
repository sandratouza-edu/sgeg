<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDIController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\GarmentController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\AttachController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\RoomController;

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

 
Route::get('/', function () {
    return redirect('/login');
});

 
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        
        //Ejemplos middlewares
    //  Route::middleware('permission:adminall')->group(function () {
    // Route::middleware('role:admin', 'role:pdi', 'role:student')->group(function () {
        //Si se quiere excluir una comprobacion de middleware.
        //Route::resource('/pdi', PDIController::class)->names('pdi')->withoutMiddleware('role:pdi');

        //Resources
        Route::resource('/user', UserController::class)->names('user');
        Route::resource('/garment', GarmentController::class)->names('garment');
        Route::resource('/pdi', PDIController::class)->names('pdi');
        Route::resource('/degree', DegreeController::class)->names('degree');
        Route::resource('/attach', AttachController::class)->names('attach');
        Route::resource('/room', RoomController::class)->names('room');

        //actions
        Route::get('/search', [UserController::class, 'search'])->name('search-get');
        Route::post('/search', [UserController::class, 'searchPost'])->name('search');
        Route::get('/garment-borrow', [GarmentController::class, 'borrow'])->name('garment.borrow');
        Route::put('/garment-save', [GarmentController::class, 'borrowSave'])->name('garment.borrowSave');
        Route::get('/garment-lend', [GarmentController::class, 'lend'])->name('garment.lend');
        Route::post('/garment-status/{garment}', [GarmentController::class, 'status'])->name('garment.status');
        Route::post('/request-delete/{garment}', [GarmentController::class, 'requestDelete'])->name('garment.requestDelete');
        Route::get('/image', [AttachController::class, 'images'])->name('image.index');
        Route::get('/upload', [AttachController::class, 'upload'])->name('image.upload');
        Route::post('/image-save', [AttachController::class, 'imageSave'])->name('image.uploadSave');

        //Multiple op
        Route::post('/multi-delete', [UserController::class, 'multiDestroy'])->name('user.multi-delete');

        Route::post('/assign-godfather', [PDIController::class, 'assignGodfather'])->name('pdi.assign-godfather');


        //Route::group(['middleware' => ['permission:role-admin']], function () {
            Route::resource('/role', RoleController::class)->names('role');
       // });
        Route::group(['middleware' => ['role:admin','permission:permission-admin']], function () {
            Route::resource('/permission', PermissionController::class)->names('permission');
        });
   // });

    // student
    Route::get('/students', [UserController::class, 'list', 'filter'=>'student'])->name('students');
    //Send email
    Route::get('/email', [MailController::class, 'index'])->name('email');
    Route::get('/sendmail', [MailController::class, 'sendMail'])->name('sendmail');
    Route::get('/preview', [MailController::class, 'previewMail'])->name('previewmail');
    Route::get('/multi-send', [MailController::class, 'multiSend'])->name('multi-sendform');
    Route::post('/multi-send', [MailController::class, 'multiSend'])->name('multi-send');
    Route::post('/multi-sendMail', [MailController::class, 'multiSendMail'])->name('multi-sendMail');


    //Message notification
    Route::get('/message', [MessageController::class, 'index'])->name('message');
    Route::get('/sendmessage', [MessageController::class, 'sendMessage'])->name('sendmessage');

    
    //Reserve
    Route::get('/reserve', [ReserveController::class, 'index'])->name('reserve');
    Route::get('/staircase', [ReserveController::class, 'staircase'])->name('staircase');
    

    //CSV import
    Route::get('/useractions', [CsvController::class, 'index'])->name('useractions');
    Route::get('/userimport', [CsvController::class, 'index'])->name('userImport');
    Route::post('/import', [CsvController::class, 'import'])->name('import');
    Route::get('/export', [CsvController::class, 'export'])->name('export');

  
    //template added
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



  //  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::post('/save', [App\Http\Controllers\SettingsController::class, 'save'])->name('saveSettings');

});
Route::get('/home', function () {
    return redirect('/login');
});
Route::get('/admin', function () {
    return redirect('/login');
});