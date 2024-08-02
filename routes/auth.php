<?php

use App\Livewire\SmtpFormComponent;
use App\Livewire\BulkUploadComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\SingleUploadComponent;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestEmailController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\EmailTrackingController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('send-otp/{userId}', [OtpVerificationController::class, 'sendOtp'])->name('send-otp');
    Route::post('otp/resend/{user}', [OtpVerificationController::class, 'resendOtp'])->name('otp.resend');

    Route::get('otp/verify/{user}', [OtpVerificationController::class, 'create'])->name('otp.verify');
    Route::post('otp/verify/{user}', [OtpVerificationController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware(['auth','check.profile', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/festivals', [DashboardController::class, 'index'])->name('festivals.index');
    Route::get('/client', [DashboardController::class, 'client_list'])->name('client.list');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients', function () {
        return view('layouts.clients');
    })->name('clients.index');
    Route::get('/festivals', [FestivalController::class, 'index'])->name('festivals.index');
    Route::get('/festivals/{festival}', [FestivalController::class, 'show'])->name('festivals.show');
    Route::get('/festivals/{festival}/participation', [FestivalController::class, 'userParticipation'])->name('festivals.participation');
    Route::post('/festivals/{festival}/signup', [FestivalController::class, 'signup'])->name('festivals.signup');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateDetails'])->name('profile.update.details');
    Route::get('/profile/update-names', [ProfileController::class, 'editNames'])->name('profile.update.names.form');
    Route::patch('/profile/update-names', [ProfileController::class, 'updateNames'])->name('profile.update.names');
    Route::get('/profile/client-upload', [ProfileController::class, 'upload'])->name('client.upload');

    Route::get('smtp-settings', SmtpFormComponent::class)->name('smtp-settings');
    //::get('test-email', [TestEmailController::class, 'create'])->name('test.email.create');
    Route::get('email-track/{id}', [EmailTrackingController::class, 'track'])->name('email.track');
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});