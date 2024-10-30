<?php

use App\Http\Controllers\Appointments\AppointmentController;
use App\Http\Controllers\Me\MeController;
use App\Http\Controllers\Professionals\AuthController;
use App\Http\Controllers\Professionals\ConfigController;
use App\Http\Controllers\Professionals\DashboardController;
use App\Http\Controllers\Professionals\HoursController;
use App\Http\Controllers\Professionals\HoursExclusionController;
use App\Http\Controllers\Professionals\ServiceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');


Route::middleware('guest')->prefix('professionals')->group(function () {
    Route::get('login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('professionals.login.store');
    Route::get('register', [AuthController::class, 'registerPage'])->name('professionals.register.show');
    Route::post('register', [AuthController::class, 'register'])->name('professionals.register.store');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('professionals.logout');

    // Hours
    Route::get('hours', [HoursController::class, 'show'])->name('hours.show');
    Route::put('hours', [HoursController::class, 'update'])->name('hours.update');

    // Hours Exclusions
    Route::get('hours-exclusions', [HoursExclusionController::class, 'index'])->name('exclusions.index');

    // Services
    Route::resource('services', ServiceController::class);

    // Config
    Route::get('config', [ConfigController::class, 'show'])->name('config.show');
    Route::put('config', [ConfigController::class, 'update'])->name('config.update');
    Route::post('config/banner', [ConfigController::class, 'updateBanner'])->name('config.update.banner');
});

// Route ME
Route::get('/me/{email}', [MeController::class, 'index'])->name('me.home');
Route::get('/me/{email}/{service}', [MeController::class, 'service'])->name('me.home.service');

// Route Clients Code

Route::post('client/code', [\App\Http\Controllers\Client\ClientController::class, 'sendCode'])->name('client.code.send');
Route::post('client/code/validation', [\App\Http\Controllers\Client\ClientController::class, 'validationCode'])->name('client.code.validation');

// Route Appointments
Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
