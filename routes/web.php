<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DoctorAppointmentController;

Route::get('/', function () {
    return redirect('register');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('doctor', DoctorController::class);
Route::resource('schedule', ScheduleController::class);
Route::resource('events', EventController::class);
Route::get('events/create', [EventController::class, 'reserve'])->name('events.reserve');



Route::get('/appointments/create', [DoctorAppointmentController::class, 'create'])->name('appointment.create');
Route::post('/appointments/store', [DoctorAppointmentController::class, 'store'])->name('appointment.store');
Route::get('/appointments', [DoctorAppointmentController::class, 'index'])->name('appointment.index');
Route::get('logout', [LoginController::class, 'logout'])->name('logout2');

