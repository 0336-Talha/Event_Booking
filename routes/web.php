<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class);
    route::post('/logout', [AuthController::class, 'logout'])->name("logout");
    Route::resource('events', EventController::class);
    Route::post('/booking_cancel/${id}', [BookingController::class, 'booking_cancel'])->name('bookings.cancel');
    Route::resource('bookings', BookingController::class);
});

Route::middleware(['guest'])->group(function () {
    route::get('/login', [AuthController::class, 'display_login'])->name("login");
    route::post('/login', [AuthController::class, 'login'])->name("logged");
    route::get('/register', [AuthController::class, 'display_register'])->name("register");
    route::post('/register', [AuthController::class, 'register'])->name("registed");
});
