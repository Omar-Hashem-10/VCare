<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\InfoController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\MajorController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\SliderController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\AppointmentController;

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


Route::apiResource('majors', MajorController::class);

Route::apiResource('doctors', DoctorController::class);

Route::apiResource('users', UserController::class);

Route::apiResource('books', BookController::class);

Route::apiResource('sliders', SliderController::class);

Route::apiResource('infos', InfoController::class);

Route::apiResource('abouts', AboutController::class);

Route::apiResource('appointments', AppointmentController::class);

Route::apiResource('contacts', ContactController::class);

Route::middleware(['api'])->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getaccount', [AuthController::class, 'getaccount']);
});
