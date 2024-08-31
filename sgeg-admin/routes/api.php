<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Auth::routes();
Route::post('createUser', [AuthController::class, 'CreateUser']);
Route::post('login', [AuthController::class, 'loginUser']);

//Ruta protegida por el middleware, si no tiene token de auth no se ejecuta
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});