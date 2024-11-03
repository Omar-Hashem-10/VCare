<?php

use App\Http\Controllers\Admin\DoctorInformationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BookeController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DoctorAppointment;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DoctorBookController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\DoctorAppointmentController;

Route::prefix('admin')->as('admin')->group(function () {

    Route::middleware(['auth:admin', 'role:superadmin,admin,doctor'])->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::resource('/majors', MajorController::class);
        Route::resource('/doctors', DoctorController::class);
        Route::resource('/sliders', SliderController::class);
        Route::resource('/info', InfoController::class);
        Route::resource('/about', AboutController::class);
        Route::resource('/appointments', AppointmentController::class);
        Route::resource('/users', UserController::class);
        Route::resource('/books', BookeController::class);
        Route::resource('/doctor-books', DoctorBookController::class);
        Route::resource('/doctor-appointment', DoctorAppointmentController::class);
        Route::resource('/contact', ContactController::class);
        Route::resource('/download', DownloadController::class);
        Route::get('/doctor-profile/{user}/edit', [ProfileController::class, 'edit'])->name('doctor-profile.edit');
        Route::put('/doctor-profile/{user}', [ProfileController::class, 'update'])->name('doctor-profile.update');
        Route::get('/doctor-profile/{user}', [ProfileController::class, 'show'])->name('doctor-profile.show');


        Route::get('/doctor-information/{doctor}', [DoctorInformationController::class, 'show'])->name('doctor-information.show');

        Route::get('/doctor-information/{doctor}/edit', [DoctorInformationController::class, 'edit'])->name('doctor-information.edit');

        Route::put('/doctor-information/{doctor}', [DoctorInformationController::class, 'update'])->name('doctor-information.update');

        Route::post('/logout', LogoutController::class)->name('auth.logout');
    });

    Route::get('/login', [LoginController::class, 'show'])->name('auth.login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');
});
