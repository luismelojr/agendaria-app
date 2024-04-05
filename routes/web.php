<?php

use App\Http\Controllers\Professionals\AuthController;
use App\Http\Controllers\Professionals\DashboardController;
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
});
