<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DoctorController;

use App\Http\Controllers\EventsController;
use App\Http\Controllers\TicketController;
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
Route::resource('event', EventsController::class);
Route::resource('ticket', TicketController::class);
Route::post('/ticket', [TicketController::class, 'store'])->name('ticket.store');
Route::post('ticket-create', [TicketController::class, 'reserve'])->name('ticket.reserve');

Route::post('event-create', [EventsController::class, 'reserve'])->name('events.reserve');
Route::get('/myTicket', [TicketController::class, 'myTicket'])->name('ticket.myTicket');
Route::get('/search', [TicketController::class, 'search'])->name('ticket.search');
Route::post('/search', [TicketController::class, 'search'])->name('ticket.search');


Route::get('/appointments/create', [DoctorAppointmentController::class, 'create'])->name('appointment.create');
Route::post('/appointments/store', [DoctorAppointmentController::class, 'store'])->name('appointment.store');
Route::get('/appointments', [DoctorAppointmentController::class, 'index'])->name('appointment.index');
Route::get('logout', [LoginController::class, 'logout'])->name('logout2');

