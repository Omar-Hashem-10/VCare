<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\BookController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\MajorController;
use App\Http\Controllers\Site\DoctorController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Site\Auth\LoginController;
use App\Http\Controllers\Site\Auth\LogoutController;
use App\Http\Controllers\Site\PatientBookController;
use App\Http\Controllers\Site\Auth\RegisterController;

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
Route::as('site.')->group(function () {
    Route::get('/', HomeController::class)->name('home');

    Route::get('/majors', MajorController::class)->name('major');

    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctor');
    Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctor.show');

    Route::get('/register', [RegisterController::class, 'show'])->name('auth.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('auth.store');

    Route::resource('/book', BookController::class);

    Route::resource('/contact', ContactController::class);


Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

Route::get('/profile/edit/{user}', [ProfileController::class, 'edit'])->name('profile.edit');

Route::put('/profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');




    Route::resource('/patient-book', PatientBookController::class);

    Route::get('/login', [LoginController::class, 'show'])->name('auth.login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');

    Route::post('/logout', LogoutController::class)->name('auth.logout');

});

