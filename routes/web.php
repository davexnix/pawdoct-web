<?php

use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Login route
Route::get('/login', [LoginController::class, 'index'])->name('login')
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);

// Signup route
Route::get('/signup', [SignUpController::class, 'index'])->name('signup')
    ->middleware('guest');
Route::post('/signup', [SignUpController::class, 'signup']);

// Forgot password route
Route::get('/forgot-password', [ResetPasswordController::class, 'index'])->name('forgot.password');
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink']);

// Reset password route
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'reset'])->name('reset-password');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset-password.update');

Route::middleware(['auth:web'])->group(function () {
    // Profile route
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update']);

    // Logout route
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');

    // Diagnosa route
    Route::get('/diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa');
    Route::post('/diagnosa', [DiagnosaController::class, 'diagnosa']);

    // Diagnosa Result route
    Route::get('/diagnosa/{id}', [DiagnosaController::class, 'result'])->name('diagnosa.result');

    // Riwayat Diagnosa route
    Route::get('/riwayat-diagnosa', [DiagnosaController::class, 'riwayat'])->name('riwayat-diagnosa');
    Route::delete('/riwayat-diagnosa/delete/{id}', [DiagnosaController::class, 'delete'])
        ->name('riwayat-diagnosa.delete');
});
