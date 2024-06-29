<?php

use App\Models\User;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFestivalController;
use App\Http\Controllers\Admin\AdminPlanController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');
    // Route::get('/plans', [AdminPlanController::class, 'index'])->name('plan');
    Route::resource('plans', AdminPlanController::class)->except(['show']);

    Route::resource('festivals', AdminFestivalController::class)->except(['show']);
    Route::get('/users', [AdminDashboardController::class, 'showUsers'])->name('users.index');
    Route::get('/festivals-list', [AdminDashboardController::class, 'showFestivals'])->name('festivals.list');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});