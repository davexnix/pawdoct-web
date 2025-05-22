<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BuletinController;
use App\Http\Controllers\Api\DiagnosisController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware('api')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::post('logout', [AuthController::class, 'logout'])
        ->middleware(['auth:api']);
    Route::post('refresh', [AuthController::class, 'refresh'])
        ->middleware(['auth:api']);
    Route::get('me', [AuthController::class, 'me'])
        ->middleware(['auth:api']);

    Route::post('forgot-password', [ResetPasswordController::class, 'sendPasswordResetLink']);
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']);
});

Route::prefix('diagnosis')->middleware(['api', 'auth:api'])->group(function () {
    Route::get('features', [DiagnosisController::class, 'getFeatures']);
    Route::get('list', [DiagnosisController::class, 'list']);
    Route::post('check', [DiagnosisController::class, 'check']);
    Route::post('save', [DiagnosisController::class, 'save']);
    Route::delete('delete/{id}', [DiagnosisController::class, 'delete']);
});

Route::prefix('buletin')->middleware(['api', 'auth:api'])->group(function () {
    Route::get('index', [BuletinController::class, 'index']);
});


Route::prefix('profile')->middleware(['api', 'auth:api'])->group(function () {
    Route::post('update', [ProfileController::class, 'update']);
});
