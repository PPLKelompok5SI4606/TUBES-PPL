<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PickupRequestController;

Route::get('/', function () {
    return view('usermain');
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Pickup Request Routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('pickup')->group(function () {
        Route::get('/', [PickupRequestController::class, 'index'])->name('pickup.index');
        Route::get('/request', [PickupRequestController::class, 'requestPage'])->name('pickup.request-page');
        Route::get('/create', [PickupRequestController::class, 'create'])->name('pickup.create');
        Route::post('/', [PickupRequestController::class, 'store'])->name('pickup.store');
        Route::get('/history', [PickupRequestController::class, 'history'])->name('pickup.history');
        Route::get('/{pickupRequest}', [PickupRequestController::class, 'show'])->name('pickup.show');
    });
});



