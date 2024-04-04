<?php

use App\Http\Controllers\Professionals\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('teste', function () {
    return redirect()->route('professionals.register.show')->toast('Testando tudo', 'error');
})->name('teste');

Route::prefix('professionals')->name('professionals.')->group(function () {
//    Route::get('login', 'Professionals\AuthController@loginPage')->name('login');
    Route::get('login', [AuthController::class, 'loginPage'])->name('login.show');
    Route::get('register', [AuthController::class, 'registerPage'])->name('register.show');
    Route::post('register', [AuthController::class, 'register'])->name('register.store');
});

require __DIR__.'/auth.php';
